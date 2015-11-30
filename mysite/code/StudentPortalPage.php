<?php

class StudentPortalPage extends Page 
{
    private static $db = array(
        'Message' => 'Text'
    );
    
    private static $defaults = array(
        'menuShown' => 'None'
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
              
        $fields->addFieldToTab("Root.Main", new TextareaField('Message', 'Message'));      
        $fields->removeByName("Content");

        return $fields;
    }
}

class StudentPortalPage_Controller extends Page_Controller 
{
    private static $allowed_actions = array(
        'RegisterForm',
        'doRegister',
        'confirm',
        'edit',
        'saveProfileForm',
        'BasicProfileForm',
        'AddressProfileForm',
        'EducationProfileForm',
        'EmergencyContactProfileForm',
        'ProfilePictureForm',
        'addMessage',
        'ajax_profile_form'
    );
    
    function init() {        
        parent::init();
        
        Requirements::set_force_js_to_bottom(true);
        Requirements::javascript("themes/one/javascript/studentedit.js");
        Requirements::javascript(
            FRAMEWORK_DIR."/admin/thirdparty/chosen/chosen/chosen.jquery.js");
        Requirements::css(
            FRAMEWORK_DIR."/admin/thirdparty/chosen/chosen/chosen.css");
    }
    
    public function index() {
        if(Permission::check('EDIT_STUDENT')) {
            return $this->redirect($this->Link('edit'));
        }
        $customData = array(
            'Title' => 'Students',
            'RegisterForm' => $this->RegisterForm()
        );
        return $this->customise($customData)->renderWith(array('PortalPage','Page'));
    }
    
    public function edit() {
        if(!Permission::check('EDIT_STUDENT')) {
            return Security::permissionFailure();
        }
        
        $student = Student::currentUser();

        $customData = array(
            'Member' => $student,
            'menuShown' => 'None',
            'AddMessageForm' => $student->MessageThreads()->First() ? MessagingController::create()->AddMessageForm($student->MessageThreads()->First()->ID) : false,
            'SessionMessage' => $this->getSessionMessage()
        );

        $controller = $this->customise($customData);
		return $controller->renderWith(array(
			'MemberProfilePage_profile', 'Page'
		));
    }
    
    public function RegisterForm() {
        $fields = new FieldList(
            new TextField('FirstName', 'FirstName<span>*</span>'),
            new TextField('Surname', 'Surname<span>*</span>'),
            new EmailField('Email', 'Email<span>*</span>'),
            ConfirmedPasswordField::create('Password', 'Password')
        );
        
        $actions = FieldList::create(
            FormAction::create('doRegister', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Register'))->addExtraClass('btn btn-primary'),
            LiteralField::create('login', '<a class="btn btn-default" data-toggle="tab" href="#login">Login</a>')
        );
        
        $required = new RequiredFields(array(
            'FirstName',
            'Email',
            'Password'
        ));
        
        return new Form($this->owner, 'RegisterForm', $fields, $actions, $required);
    }
    
    public function doRegister(array $data, Form $form) {
        $student = new Student();
        
        $form->saveInto($student);
        
        $student->NeedsValidation = true;
        $student->NeedsApproval = false;
        
        $blogTree = SiteTree::get()->filter(array(
            'ClassName' => 'BlogTree',
        ))->First();
        
        //create new blog tree if not exists        
        if(!$blogTree) {
            $blogTree = new blogTree();
            $blogTree->Title = "Student Blogs";
            $blogTree->URLSegment = "student-blogs";
            $blogTree->Status = "Published";
            $blogTree->write();
            $blogTree->doRestoreToStage();
        }
        
        $student->createNewStudentBlog($blogTree);
        
        try {
			$student->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}
               

        $studentGroup = DataObject::get_one('Group', "Code='students'");
        
        if(!$studentGroup) {
            $studentGroup = new Group();
            $studentGroup->Code = "students";
            $studentGroup->Title = "Students";
            $studentGroup->Description = "All registered students";
            $LinkedPage = StudentPortalPage::get()->First();
            $studentGroup->LinkedPageID = $LinkedPage->ID;
            
            $studentGroup->Write();
        }
        $studentGroup->Members()->add($student);

        $email = new Email();
        $email
            ->setFrom('noreply@genxyz.ca')
            ->setTo($student->Email)
            ->setSubject('Registration Confirmation')
            ->setTemplate('RegistrationVerification')
            ->populateTemplate(new ArrayData(array(
                'Member' => $student,
                'ConfirmLink' => $this->Link('confirm/'.$student->ID."?key={$student->ValidationKey}"),
                'LoginLink' => $this->Link(),
                'LostPasswordLink' => Director::absoluteURL(singleton('Security')->Link('lostpassword'))
            )));
                
        $email->send();
        
        
        $customData = array(
            'Content' => 'Check your email to validate your account. If you can\'t see an email, check in your spam folder.',
            'Title' => 'Successfully registered'
        );
        
        return $this->customise($customData)->renderWith(array('Page'));
    }
    
    public function confirm($request) {
		if(Member::currentUser()) {
			return Security::permissionFailure ($this, _t (
				'MemberProfiles.CANNOTCONFIRMLOGGEDIN',
				'You cannot confirm account while you are logged in.'
			));
		}

		if (
			(!$id = $request->param('ID')) || (!$key = $request->getVar('key')) || !is_numeric($id)
			|| !$member = DataObject::get_by_id('Member', $id)
		) {
			$this->httpError(404);
		}

		if($member->ValidationKey != $key || !$member->NeedsValidation) {
			$this->httpError(403, 'You cannot validate this member.');
		}

		$member->NeedsValidation = false;
		$member->ValidationKey   = null;
		$member->write();

		$member->logIn();

		return $this->redirect($this->Link('edit'));
	}
    
    public function ajax_profile_form() {
        if(!Permission::check('EDIT_STUDENT')) {
            return Security::permissionFailure('You cannot edit this profile');
        }
        
        if(!isset($_GET['Name'])) {
            http_response_code(404);
            return array();
        }
        
        return $this->getProfileForm($_GET['Name']);
    }
    
    public function getProfileForm($formName, Member $member = null) {
        $form = null;
        
        if(!Permission::check('EDIT_STUDENT')) { return http_response_code(403); }
        $member = Member::currentUser();
        
        switch($formName)
        {
            case "Basic":
                $form = $this->BasicProfileForm($member);
                break;
            case "Address":
                $form = $this->AddressProfileForm($member);
                break;
            case "Education":
                $form = $this->EducationProfileForm($member);
                break;
            case "Contact":
                $form = $this->EmergencyContactProfileForm($member);
                break;
            case "ProfilePicture":
                $form = $this->ProfilePictureForm($member);
                break;
            default:
                $form = null;
                break;
        }
        
        if(Director::is_ajax() && !$form) {
            http_response_code(404);
            return array();
        } else if(!$form) { 
            return false;
        }
        
        $form->loadDataFrom($member);
        
        if(Director::is_ajax()) {
            return $form->forTemplate();
        } else {
            return $form;
        }
    }
    
    
    /**
    //Forms on Member Profile Page
    // 1. Basic Profile Form
    // 2. Education Form
    // 3. Address Form
    // 4. Emergency Contact Form
    // 5. Upload profile picture form
    //
    // Session['profile_saved'] set to 1 on success and 2 on failure
    **/
    
    //form for basic info on profile
    public function BasicProfileForm(Member $member = null) {
        if(!$member) {
            $member = Member::currentUser();
        }
        
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>' . _t(
                'MemberProfileForms.BASICLABEL',
                'Basic Information') . '</h2>'),
            TextField::create('FirstName', _t(
                'MemberProfileForms.FIRSTNAME',
                'First Name') . '<span>*</span>')
                ->setAttribute('placeholder', 'Enter your first name'),
            TextField::create('MiddleName', _t(
                'MemberProfileForms.MIDDLENAME',
                'Middle Name'))
                ->setAttribute('placeholder', 'Enter your middle name'),
            TextField::create('Surname', _t(
                'MemberProfileForms.SURNAME',
                'Surname') . '<span>*</span>')
                ->setAttribute('placeholder', 'Enter your last name'),
            new DateField('DateOfBirth', _t(
                'MemberProfileForms.BIRTHDAY',
                'Birthday')),
            DropdownField::create('NationalityID', _t(
                'MemberProfileForms.NATIONALITY',
                'Nationality'), array('selected' => $member->NationalityID))->setEmptyString('Select a Country')->addExtraClass('country-select-dropdown'),
            EmailField::create('Email', _t(
                'MemberProfileForms.EMAIL',
                'Email') . '<span>*</span>')
                ->setAttribute('placeholder', 'Enter a valid email address')
        );
        
        $actions = new FieldList(
            FormAction::create('saveProfileForm', _t(
                'MemberProfileForms.SAVEBUTTON',
                'Save'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'FirstName',
            'Surname',
            'Email'
        ));
        
        return new Form($this->owner, 'BasicProfileForm', $fields, $actions, $required);
    }
    
    //form for address input
    public function AddressProfileForm(Member $member = null) {
        if(!$member) {
            $member = Member::currentUser();
        }
        
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>' . _t(
                'MemberProfileForms.CURRENTADDRESS',
                'Current Address') . '</h2>'),
            TextField::create('StreetAddress', _t(
                'MemberProfileForms.STREETADDRESS',
                'Street Address') . '<span>*</span>')
                ->setAttribute('placeholder', 'Enter your current address'),
            DropdownField::create('CurrentCountryID', _t(
                'MemberProfileForms.COUNTRY',
                'Country') . '<span>*</span>', array('selected' => $member->CurrentCountryID))->setEmptyString('Select a Country')->addExtraClass('country-select-dropdown country-for-city-select'),
            DropdownField::create('CityID', _t(
                'MemberProfileForms.CITY',
                'City'))->setEmptyString('Select a Country to view Cities')->addExtraClass('city-select-dropdown')
                ->setAttribute('data-selected-city', $member->CityID),
            TextField::create('PostalCode', _t(
                'MemberProfileForms.POSTALCODE',
                'Postal Code'))
                ->setAttribute('placeholder', 'Enter your current postal code'),
            
            new HiddenField('Username', 'Username'),
            new HiddenField('Email', 'Email')
        );
        
        $actions = new FieldList(
            FormAction::create('saveProfileForm', _t(
                'MemberProfileForms.SAVEBUTTON',
                'Save'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'StreetAddress',
            'Country'
        ));
        
        return new Form($this->owner, 'AddressProfileForm', $fields, $actions, $required);
    }

    //education info form
    public function EducationProfileForm(Member $member = null) {
        if(!$member) {
            $member = Member::currentUser();
        }
               
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>' . _t(
                'MemberProfileForms.EDUCATIONLABEL',
                'Education Information') . '</h2>'),
            TextField::create('Agency', _t(
                'MemberProfileForms.AGENCY',
                'Agency'))
                ->setAttribute('placeholder', 'Enter any academic agencies you\'re working with'),
            new DropdownField('HighSchoolID', _t(
                'MemberProfileForms.HIGHSCHOOL',
                'High School') . '<span>*</span>', HighSchool::getHighSchoolOptions()),
            new DateField('HSGraduation', _t(
                'MemberProfileForms.HIGHSCHOOLGRAD',
                'High School Graduation Date')),
            new DropdownField('UniversityID', _t(
                'MemberProfileForms.UNIVERSITY',
                'University') . '<span>*</span>', University::getUniversityOptions()),
            new DateField('UniversityGraduation', _t(
                'MemberProfileForms.UNIVERSITYGRAD',
                'University Graduation Date')),
            
            new HiddenField('Username', 'Username'),
            new HiddenField('Email', 'Email')
        );
        
        $actions = new FieldList(
            FormAction::create('saveProfileForm', _t(
                'MemberProfileForms.SAVEBUTTON',
                'Save'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'HighSchoolID',
        ));

        return new Form($this->owner, 'EducationProfileForm', $fields, $actions, $required);
    }
     
    public function EmergencyContactProfileForm(Member $member = null) {
        if(!$member) {
            $member = Member::currentUser();
        }
        
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>' . _t(
                'MemberProfileForms.EMERGENCYCONTACTLABEL',
                'Emergency Contact Details') . '</h2>'),
            TextField::create('ContactFirstName', _t(
                'MemberProfileForms.FIRSTNAME',
                'First Name') . '<span>*</span>')
                ->setAttribute('placeholder', 'Enter your contact\'s first name'),
            TextField::create('ContactSurname', _t(
                'MemberProfileForms.SURNAME',
                'Family Name') . '<span>*</span>')
                ->setAttribute('placeholder', 'Enter your contact\'s last name'),
            PhoneNumberField::create('ContactTelephone', _t(
                'MemberProfileForms.CONTACTTELEPHONE',
                'Telephone'))
                ->setAttribute('placeholder', 'Enter your contact\'s phone number'),
            DropdownField::create('ContactCountryID', _t(
                'MemberProfileForms.COUNTRY',
                'Current Country'), array('selected' => $member->ContactCountryID))->setEmptyString('Select a Country')->addExtraClass('country-select-dropdown'),
            EmailField::create('ContactEmail', _t(
                'MemberProfileForms.EMAIL',
                'Email') . '<span>*</span>')
                ->setAttribute('placeholder', 'Enter your contact\'s primary email'),

            new HiddenField('Username', 'Username'),
            new HiddenField('Email', 'Email')
        );
        
        $actions = new FieldList(
            FormAction::create('saveProfileForm', _t(
                'MemberProfileForms.SAVEBUTTON',
                'Save'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'ContactFirstName',
            'ContactSurname',
            'ContactEmail'
        ));

        return new Form($this->owner, 'EmergencyContactProfileForm', $fields, $actions, $required);
    }
    
    public function ProfilePictureForm($member = null) {
        if(!$member) {
            $member = Member::currentUser();
        }
        
        $fields = new FieldList(
            new LiteralField('Hd_ProfilePicture', '<h3>' . _t(
                'MemberProfileForms.PROFILEPICTUREUPLOAD',
                'Upload A New Profile Picture') . '</h3>'),
            new HiddenField('Email', 'Email')
        );
        $UploadField = new UploadField('ProfilePicture', 'Upload a new profile picture');
        $UploadField->setAllowedFileCategories('image');
        $UploadField->setAllowedMaxFileNumber(1);
        $UploadField->setCanPreviewFolder(false);
        $UploadField->upload->setReplaceFile(true);
        $UploadField->setOverwriteWarning(true);
        $UploadField->setFolderName('students/'.$member->ID.'/ProfilePicture');

        $fields->insertBefore($UploadField, 'Email');
        
        $actions = new FieldList(
            FormAction::create('saveProfileForm', _t(
                'MemberProfileForms.UPLOAD',
                'Upload'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'ProfilePicture'
        ));

        return new Form($this->owner, 'ProfilePictureForm', $fields, $actions, $required);
    }
    
    public function saveProfileForm(array $data, Form $form) {
        $member = Member::currentUser();

        $form->saveInto($member);
		
        try {
			$member->write();
		} catch(ValidationException $e) {
            Session::set('SessionMessage', $e->getResult()->message());
            Session::set('SessionMessageContext', 'danger');
        
			return $this->owner->redirectBack();
		}

		Session::set('SessionMessage', 'Your profile has been updated and saved.');
        Session::set('SessionMessageContext', 'success');
        
		return $this->owner->redirectBack('?saved=1');//($this->Link('?saved=1'));
	}
}