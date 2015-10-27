<?php
//Adds hooks to: 
//  Profile page forms
//  Register form
//  Member add
class MemberProfilePage_ControllerDecorator extends DataExtension {
    
    private static $allowed_actions = array(
        'saveProfileForm',
        'BasicProfileForm',
        'AddressProfileForm',
        'EducationProfileForm',
        'EmergencyContactProfileForm',
        'ProfilePictureForm',
    );
    
    function init() {
        parent::init();
        
        SSViewer::setOption('rewriteHashlinks', false);
        
        if(!Member::currentUserID() || !Member::currentUser()->isStudent()) {
            Security::permissionFailure(null, 'You need to be logged in a student profile to view this content.');
        }
    }
            
    //student registration form
    public function updateRegisterForm($form) {
        $fields = $form->Fields();
		
        $fields->insertBefore(LiteralField::create('Hd_Personal', '<h3>' . _t(
            'MemberRegForm.PERSONALINFOLABEL', 
            'Personal Info') . '</h3>'), 'FirstName');
        $fields->dataFieldByName('FirstName')->setAttribute('placeholder','Enter your first name.');
        $fields->dataFieldByName('Surname')->setAttribute('placeholder','Enter your last name.');
        $fields->dataFieldByName('Email')->setAttribute('placeholder','Enter a valid email we can confirm.');
        $fields->insertBefore(new LiteralField('Hd_Security', '<h3>' . _t(
            'MemberRegForm.SECUTRIYLABEL', 
            'Security') . '</h3>'), 'Password');
        $termsPage = TermsAndConditionsPage::get()->First();
        $fields->insertAfter(new LiteralField('TermsConditions', '<p>' . _t(
            'MemberRegForm.TERMSCONDITIONS', 
            'By registering you confirm you have read and understood our <a href="' . $termsPage->Link() . '" target="_blank">terms and conditions</a></p>') . '</h4>'), 'Password');
        $fields->dataFieldByName('Password')->setAttribute('placeholder', 'Enter a password');
        
        $required = new RequiredFields(array(
            'FirstName',
            'Surname',
            'Email',
            'Password'
        ));
        
        $form->setFields($fields);
        $form->setValidator($required);
    }
    
    //---Profile Page Data---//
    
    //add extra data to profile page
    public function updateProfilePageData(&$pageData) {
        unset($pageData['Form']);
        
        $member = Member::currentUser();
        $pageData['Member'] = $member;
        
        $pageData['IsStudent'] = true;
        
    //pass link to student chatroom with username as 'firstName lastName' and link to user profile in 'userurl'
        $chatName = preg_replace("/[^A-Za-z0-9]/", "", $member->FirstName) . '%20' . preg_replace("/[^A-Za-z0-9]/", "", $member->Surname);
        $userurl = Director::absoluteURL("myprofile/show/".$member->ID, true);
        
        $pageData['ChatLink'] = "http://localhost/ajax/chat?userName=" . $chatName . "&userID=".$member->ID;

        $pageData['IsSelf'] = $member->ID == Member::currentUserID();
            
        // get info for members blog
        $holder = BlogHolder::get()->filter(array(
            'ownerID' => $member->ID
        ))->First();
        
        if(!$holder) {
            $pageData['BlogEntries'] = false;
            return $pageData;
        }
        
        $pageData['BlogPostURL'] = $holder->Link() . "post";
        $pageData['BlogURL'] = $holder->Link();
        
        $entries = BlogEntry::get()->filter(array(
            'ParentID' => $holder->ID
        ))->limit(10);
        
        $pageData['BlogEntries'] = $entries;
        $pageData['isProfileSaved'] = isset($_SESSION['profile-form-saved']) ? true : false;
        
        if(isset($_SESSION['profile-form-saved']))
           unset($_SESSION['profile-form-saved']);
        
        return $pageData;
    }
    
    public function getIncludeTemplate() {
        
    }
    
    // get profile picture
    public function ProfilePicture($member = null) {
        if(!$member) {
            $member = Member::currentUser();
        }
        
        $profilePicture = File::get()->filter(array(
            'ClassName' => 'Image',
            'ID'        => $member->ProfilePictureID
        ))->First();
        if(!$profilePicture) {
            return "assets/Uploads/default.jpg";
        } else {
            return $profilePicture->Filename;
        }
    }
    
    public function BlogManagementURLs($member = null) {
        if(!$member) $member = Member::currentUser();
        
        //if not a student, member has no blog to manage
        if(!$member->isStudent()) {
            return "You do not have a blog to manage.";
        }
        
        //get blog holder for member
        $holder = BlogHolder::get()->filter(array(
            'ownerID' => $member->ID
        ))->First();
        
        if(!$holder) {
            $blogTree = SiteTree::get()->filter(array(
                'ClassName' => 'BlogTree'
            ))->First();
            $blogID = $this->createNewStudentBlog($member, $blogTree);
            $holder = BlogHolder::get()->ByID($blogID);
        }
        
        $urls = "<li><a class='button small icon fa-pencil-square-o' title='Create a new blog post' href='". $holder->Link() . "post'>" . _t('StudentProfile.NEWBLOGPOST', 'New Blog Post') . "</a></li>";
        $urls .= "<li><a class='button small icon fa-file-o' title='View main blog page' href='". $holder->Link() . "'>" . _t('StudentProfile.VIEWMYBLOG', 'My Blog Posts') . "</a></li>";
        $urls .= "<li><a class='button small icon fa-files-o' title='View main blog page' href='". $holder->parent()->Link() . "'>" . _t('StudentProfile.VIEWALLBLOG', 'All Blog Posts') . "</a></li>";
        
        return $urls;
    }
    
    public function getProfileForm($formName, Member $member = null) {
        $form = null;
        
        if(!$member) {$member = Member::currentUser();}
        
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
        
        if(!$form) { 
            user_error("Profile Form not found!", E_USER_ERROR); 
            return false;
        }
        
        $form->loadDataFrom($member);
        
        return $form;
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
            new FormAction('saveProfileForm', _t(
                'MemberProfileForms.SAVEBUTTON',
                'Save'))
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
            new FormAction('saveProfileForm', _t(
                'MemberProfileForms.SAVEBUTTON',
                'Save'))
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
            new FormAction('saveProfileForm', _t(
                'MemberProfileForms.SAVEBUTTON',
                'Save'))
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
            new FormAction('saveProfileForm', _t(
                'MemberProfileForms.SAVEBUTTON',
                'Save'))
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
            new HiddenField('Username', 'Username'),
            new HiddenField('Email', 'Email')
        );
        $UploadField = new UploadField('ProfilePicture', 'Upload a new profile picture');
        $UploadField->setAllowedFileCategories('image');
        $UploadField->setAllowedMaxFileNumber(1);
        $UploadField->setCanPreviewFolder(false);
        $UploadField->upload->setReplaceFile(true);
        $UploadField->setOverwriteWarning(true);
        $UploadField->setFolderName('Uploads/ProfilePictures');

        $fields->insertBefore($UploadField, 'Username');
        
        $actions = new FieldList(
            new FormAction('saveProfileForm', _t(
                'MemberProfileForms.UPLOAD',
                'Upload'))
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
			$form->sessionMessage($e->getResult()->message(), 'bad');
            
			return $this->owner->redirectBack();
		}

		$form->sessionMessage (
			_t('MemberProfiles.PROFILEUPDATED', 'Your profile has been updated!'),
			'good'
		);
        Session::set('profile-form-saved', 1);
        
		return $this->owner->redirectBack('?saved=1');//($this->Link('?saved=1'));
	}
    
    function AllForums($num=5) {
        $holder = Forum::get()->First();
        
        if(!$holder) { return false; }
        
        return ($holder) ? Forum::get()->limit($num) : false;    
    }
    
    //---End Profile Page Data---//
    
    
    //Done after member added
    //1. Create Blog Page
    //2. Add member to appropriate groups
    public function onAddMember($member) {
        //---- 1. Create Blog Page
        //get existing blog tree
        $blogTree = SiteTree::get()->filter(array(
            'ClassName' => 'BlogTree',
        ))->First();
        
        //create new blog tree if not exists        
        if(!$blogTree)
        {
            $blogTree = new blogTree();
            $blogTree->Title = "Student Blogs";
            $blogTree->URLSegment = "student-blogs";
            $blogTree->Status = "Published";
            $blogTree->write();
            $blogTree->doRestoreToStage();
        }
        
        //create new blog holder for member
        $this->createNewStudentBlog($member, $blogTree);
        
        //---- 2. add member to groups: student, user
        $userGroup = DataObject::get_one('Group', "Code = 'students'");

        if(!$userGroup)
        {
            $userGroup = new Group();
            $userGroup->Code = "students";
            $userGroup->Title = "Students";
            $userGroup->Description = "All registered students";
            $LinkedPage = SiteTree::get()->filter(array(
                'ClassName' => 'MemberProfilePage',
                'Title' => 'MyProfile'))->First();
            $userGroup->LinkedPageID = $LinkedPage->ID;
            
            $userGroup->Write();
        }
        //Add member to user group
        $userGroup->Members()->add($member);
        
        //set member type to student
        $member->MemberType = "Student";
        $member->PointsEarned = 1;
        
        $member->write();
    }
    
    private function createNewStudentBlog(Member $member, BlogTree $blogTree) {
        $blogHolder = new BlogHolder();
        $blogHolder->Title = $member->FirstName."-".$member->Surname."-".$member->ID;
        $blogHolder->AllowCustomAuthors = false;
        $blogHolder->OwnerID = $member->ID;
        $blogHolder->URLSegment = $member->FirstName."-".$member->Surname."-".$member->ID;
        $blogHolder->Status = "Published";
        $blogHolder->ParentID = $blogTree->ID;
        
        $widgetArea = new WidgetArea();
        $widgetArea->write();
        
        $blogHolder->SideBarWidgetID = $widgetArea->ID;
        $blogHolder->write();
        $blogHolder->doRestoreToStage();
        $blogHolder->menuShown = 'Student';
        
        //Tag Cloud Widget
        $tagcloudwidget = new TagCloudWidget();
        $tagcloudwidget->ParentID = $widgetArea->ID;
        $tagcloudwidget->Enabled = 1;
        $tagcloudwidget->write();
        //Archive Widget
        $archiveWidget = new ArchiveWidget();
        $archiveWidget->ParentID = $widgetArea->ID;
        $archiveWidget->Enabled = 1;
        $archiveWidget->write();
        
        //create welcome blog entry
        $blog = new BlogEntry();
        $blog->Title = "Welcome to the ISNetwork " . $member->FirstName . "!";
        $blog->Author = "Admin";
        $blog->URLSegment = 'first-post';
        $blog->Tags = "created, first, welcome";
        $blog->Content = "<p>Thank you for registering with the ISNetwork. Take a look around.</p><p>Blog Management will be restricted to student mentors as of September 14th. Email admin@genxyz.ca with some details about yourself to become a mentor.";
        $blog->Status = "Published";
        $blog->ParentID = $blogHolder->ID;
        $blog->write();
        $blog->doRestoreToStage();
        
        return $blogHolder->ID;
    }
    
}