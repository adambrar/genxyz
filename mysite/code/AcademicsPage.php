<?php 
 
class AcademicsPage extends Page 
{
    private static $db = array(
         'Updates' => 'HTMLText',
         'RecentlyAdded' => 'HTMLText',
     );
    
private static $defaults = array(
        'menuShown' => 'Student',
        'menuWelcome' => false,
        'menuStudent' => true
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
              
        $fields->addFieldToTab("Root.Main", new HTMLEditorField('Updates', 'About'));      
        $fields->addFieldToTab("Root.Main", new HTMLEditorField('RecentlyAdded', 'Recently Added'));
        
        $fields->removeByName("Content");

        return $fields;
    }
}
 
class AcademicsPage_Controller extends Page_Controller 
{
    private static $allowed_actions = array(
        'saveProfileForm',
        'BasicProfileForm',
        'AddressProfileForm',
        'EducationProfileForm',
        'ContactProfileForm',
        'EmergencyContactProfileForm',
        'ProfilePictureForm',
        'FilterAcademics',
        'search',
        'show',
        'searchprogramsasjson',
        'searchcountriesasjson',
        'doAcademicsSearch'
    );
    
    private static $url_handlers = array(
        'university/$MemberID!' => 'show',
        'agent/$MemberID!' => 'show',
    );
    
    function init() {
        Requirements::javascript(Director::baseFolder() . '/themes/' . SSViewer::current_theme() . '/javascript/academicfilter.js');
        HTMLEditorField::include_js();
        
        parent::init();
        
        if(!Member::currentUserID() || !Member::currentUser()->isStudent()) {
            Security::permissionFailure(null, 'You need to be logged into a student profile to view this content.');
        }
    }
    
    public function show() {
        return new AcademicsProfileViewer($this, 'show');
    }
    
    public function FilterAcademics() {
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h1>' . _t(
                'AcademicsSearchForm.DEFAULT',
                'Filters') . '</h1>'),
            DropdownField::create('Country', _t(
                'AcademicsSearchForm.COUNTRY',
                'Country'))->setEmptyString('Select a country')->addExtraClass('filter-by-country'),
            DropdownField::create('Program', _t(
                'AcademicsSearchForm.DEFAULT',
                'Program'), Program::getProgramOptions())->setEmptyString('Select Program')->addExtraClass('filter-by-program')
        );
        
        $actions = FieldList::create(
            FormAction::create('doAcademicsSearch', _t(
                'MemberProfileForms.DEFAULT',
                'Filter'))->addExtraClass('academic-search-button')
        );
        
        $required = new RequiredFields(array(
            'FirstName',
            'Surname',
            'Email'
        ));
        
        return new Form($this->owner, 'FilterAcademics', $fields, $actions, $required);
    }
    
    public function doAcademicsSearch(array $data, Form $form) {
        if($data['Country'] == '' && $data['Program'] == '') {
            $form->addErrorMessage('Blurb', 'Select filters to search!', 'bad');
            return $this->owner->redirectBack();
        }
        
        $filter = array('MemberType' => 'University');
        
        if($data['Country'] != '') {
            $filter['BusinessCountryID'] = Convert::raw2sql($data['Country']);
        }
        
        $universities = Member::get()->filter($filter);
        
        return $this->owner->redirect(
            $this->Link('?Country='.Convert::raw2sql($data['Country'])
                            .'&Program='.Convert::raw2sql($data['Program'])));

    }
    
    public function Member() { return Member::currentUser(); }

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
                user_error("Profile Form not found!", E_USER_ERROR);
                break;
        }
        
        if(!$form) { 
            user_error("Profile Form not found!", E_USER_ERROR); 
            return false;
        }
        
        $form->loadDataFrom($member);
        
        return $form;
    }
        
    
    //form for basic info on profile
    public function BasicProfileForm() {
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>' . _t(
                'MemberProfileForms.BASICLABEL',
                'Basic Information') . '</h2>'),
            new TextField('FirstName', _t(
                'MemberProfileForms.FIRSTNAME',
                'First Name') . '<span>*</span>'),
            new TextField('MiddleName', _t(
                'MemberProfileForms.MIDDLENAME',
                'Middle Name')),
            new TextField('Surname', _t(
                'MemberProfileForms.SURNAME',
                'Surname') . '<span>*</span>'),
            new DateField('DateOfBirth', _t(
                'MemberProfileForms.BIRTHDAY',
                'Birthday')),
            new DropdownField('Nationality', _t(
                'MemberProfileForms.NATIONALITY',
                'Nationality'), Country::getCountryOptions()),
            new EmailField('Email', _t(
                'MemberProfileForms.EMAIL',
                'Email') . '<span>*</span>')
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
    public function AddressProfileForm() {
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>' . _t(
                'MemberProfileForms.CURRENTADDRESS',
                'Current Address') . '</h2>'),
            new TextField('StreetAddress', _t(
                'MemberProfileForms.STREETADDRESS',
                'Street Address') . '<span>*</span>'),
            new DropdownField('City', _t(
                'MemberProfileForms.CITY',
                'City'), City::getCityOptions()),
            new DropdownField('Country', _t(
                'MemberProfileForms.COUNTRY',
                'Country') . '<span>*</span>', Country::getCountryOptions()),
            new TextField('PostalCode', _t(
                'MemberProfileForms.POSTALCODE',
                'Postal Code')),
            
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
    public function EducationProfileForm() {
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>' . _t(
                'MemberProfileForms.EDUCATIONLABEL',
                'Education Information') . '</h2>'),
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
     
    public function EmergencyContactProfileForm() {
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>' . _t(
                'MemberProfileForms.EMERGENCYCONTACTLABEL',
                'Emergency Contact Details') . '</h2>'),
            new TextField('ContactFirstName', _t(
                'MemberProfileForms.FIRSTNAME',
                'First Name') . '<span>*</span>'),
            new TextField('ContactSurname', _t(
                'MemberProfileForms.SURNAME',
                'Family Name') . '<span>*</span>'),
            new PhoneNumberField('ContactTelephone', _t(
                'MemberProfileForms.CONTACTTELEPHONE',
                'Telephone')),
            new CountryDropdownField('ContactCountry', _t(
                'MemberProfileForms.COUNTRY',
                'Current Country')),
            new EmailField('ContactEmail', _t(
                'MemberProfileForms.EMAIL',
                'Email') . '<span>*</span>'),

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
    
    public function ProfilePictureForm() {
        
        $fields = new FieldList(
            new LiteralField('Hd_ProfilePicture', '<h3>' . _t(
                'MemberProfileForms.PROFILEPICTUREUPLOAD',
                'Upload A New Profile Picture') . '</h3>'),
            new HiddenField('Username', 'Username'),
            new HiddenField('Email', 'Email')
        );

        $imageUpload = new FileField('ProfilePicture', 'Use a .jpg or .png image file');
        $imageUpload->getValidator()->allowedExtensions = array('jpg', 'png');

        $fields->insertBefore($imageUpload, 'Username');
        
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

        $SQL_data = Convert::raw2SQL($data);

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
        
		return $this->owner->redirectBack();
	}
    
    public function searchcountriesasjson($message = "", $extraData = null, $status = "success") {
        $this->response->addHeader('Content-Type', 'application/json');
        SSViewer::set_source_file_comments(false);
		if($status != "success") {
			$this->setStatusCode(400, $message);
		}
		// populate Javascript
		$js = array();
        $js[] = array(
            'title' => 'first',
            'value' => 'firstvalue'
        );
        
        $countries = Country::get()->filter(array(
            'ID' => 'Members.BusinessCountryID'
        ))->sort('Name', 'ASC');
        
        if($countries)
        {
            foreach($countries as $country)
            {
                $js[] = array(
                    "title" => $country->Name,
                    "value" => $country->ID
                );
            }
        }
        
        if(is_array($extraData)) { $js = array_merge($js, $extraData); }
        
        $json = json_encode($js);
        
        return $json;
    }
    
    public function PaginatedUniversities() {
        $filter = array('MemberType' => 'University');
        
        if($this->request->getVar('Country') != '' && 
           ctype_digit($this->request->getVar('Country'))) {
            $filter['BusinessCountryID'] = Convert::raw2sql($this->request->getVar('Country'));
        }
        
        $reqProgram = $this->request->getVar('Program');
        if($reqProgram != '' && ctype_digit($reqProgram)) {
            $filter['Programs.ProgramNameID'] = Convert::raw2sql($this->request->getVar('Program'));
        }
        
        $list = Member::get()->filter($filter);

        $paginated = new PaginatedList($list, Controller::curr()->request);
        
        $paginated->setPageLength(25);
        
        return $paginated;
    }
    
    public function getCountryName($id) {
        return Country::getCountryName($id);
    }
    
    public function LogoLink($id) {
        $member = Member::get()->ByID($id);
        if(!$member || $member->isStudent($member) || !$member->PartnersProfileID)
            return false;
        
        $profile = PartnersProfile::get()->ByID($member->PartnersProfileID);
        if(!$profile || !$profile->LogoImageID) {
            return Director::baseURL() . 'assets/Uploads/default.jpg';
        } else {
            return File::get()->filter(array(
                'ClassName' => 'Image',
                'ID'        => $profile->LogoImageID
            ))->First()->Link();
        }    
    }
}