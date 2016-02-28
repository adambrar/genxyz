<?php

class SchoolPortalPage extends Page 
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

class SchoolPortalPage_Controller extends Page_Controller
{
    private static $allowed_actions = array(
        'RegisterForm',
        'edit',
        'preview',
        'search',
        'show',
        'BasicInfoForm',
        'ProfileLinksForm',
        'saveProfilePage',
        'AddProgramForm',
        'EditProgramForm',
        'addProgram',
        'editProgram',
        'deleteProgram',
        'ajaxProgramRequest',
        'SchoolPartnersForm',
        'saveSchoolPartners',
        'AgentPartnersForm',
        'saveAgentPartners',
        'rateschool'
    );
    
    private static $url_handlers = array(
        'search/$Country/$Program/$SchoolName/$Level' => 'search'
    );
    
    protected $FilterSchools;
    
    function init() {
        parent::init();
        
        Requirements::set_force_js_to_bottom(true);
        Requirements::javascript("themes/one/javascript/schooledit.js");
        Requirements::javascript("themes/one/javascript/bootstrap-rating.min.js");
        Requirements::javascript("themes/one/javascript/minimal-overlay.js");
        Requirements::javascript(
            FRAMEWORK_DIR."/admin/thirdparty/chosen/chosen/chosen.jquery.js");
        Requirements::css(
            FRAMEWORK_DIR."/admin/thirdparty/chosen/chosen/chosen.css");
    }
    
    public function index() {
        if(Permission::check('EDIT_SCHOOL')) {
            $this->redirect($this->Link('edit'));
        }
        
        $customData = array(
            'RegisterForm' => $this->RegisterForm(),
            'Title' => 'Schools',
            'BrowseLink' => $this->Link('search')
        );
        
        return $this->customise($customData)->renderWith(array('PortalPage','Page'));
    }
    
    public function search() {
        if(!isset($this->FilterSchools)) {
            $this->FilterSchools = SearchPage_Controller::create()->FilterSchools();
        }
        
        $filter = array();
        $ids = array();
        if( ($this->getRequest()->param('Country') != '0') &&
           ctype_digit($this->getRequest()->param('Country')) ) {
            $filter['CountryID'] = $this->getRequest()->param('Country');
        }
        if( ($this->getRequest()->param('Program') != '0') &&
           ctype_digit($this->getRequest()->param('Program')) ) {
            $ids = Program::get()->filter(array(
                'ProgramName.ID' => $this->getRequest()->param('Program')
            ))->column('SchoolID');
            
            if($ids) {
                $filter['ID'] = $ids;
            }
        }
        if( ($this->getRequest()->param('Level') != '0') &&
           ctype_digit($this->getRequest()->param('Level')) ) {
            $filter['Type'] = $this->getRequest()->param('Level');
        }
        if( ($this->getRequest()->param('SchoolName') != '0') &&
            ($this->getRequest()->param('SchoolName') != null) ) {
            $filter['Name:PartialMatch:nocase'] = $this->getRequest()->param('SchoolName');
        }
        
        if( $ids || $this->getRequest()->param('Program') == null ||
            $this->getRequest()->param('Program') == '0' ) {
            $schools = School::get()->filter($filter);
            $paginated = PaginatedList::create($schools, $this->getRequest())->setPageLength(10);
            
        } else {
            $paginated = false;
        }
        
        if(Director::is_ajax()) {
            return $this->renderWith('SchoolResults', ['PaginatedResults' => $paginated]);
        }
        
        Requirements::javascript("themes/one/javascript/jquery.bootpag.min.js");
        Requirements::javascript("themes/one/javascript/searchpage.js");
        
        $customData = array(
            'PaginatedResults' => $paginated,
            'Title' => 'School search results',
            'Content' => 'Browse our schools.',
            'SearchPageLink' => SearchPage::get()->First()->Link(),
            'SchoolFilter' => $this->FilterSchools
        );
        
        return $this->customise($customData)->renderWith(array(
            'SchoolPortalPage_search','Page'
        ));
    }
    
    public function edit() {
        if(!Permission::check('EDIT_SCHOOL')) {
            return Security::permissionFailure();
        }
        
        $school = School::currentUser();
        
        $profileContent = PartnersProfile::get()->byID($school->PartnersProfileID);
        
        //check user has profile page and create if not
        if(!$profileContent) {
            $profileContent = new PartnersProfile();
            $school->PartnersProfileID = $profileContent->write();
            $school->write();
        }
        
        $customData = array(
            'Member' => $school,
            'menuShown' => 'None',
            'BasicInfo' => $this->BasicInfoForm()->loadDataFrom($school),
            'ProfileLinks' => $this->ProfileLinksForm()->loadDataFrom($profileContent),
            'AddPrograms' => $this->AddProgramForm(),
            'EditPrograms' => $this->EditProgramForm(),
            'SchoolPartnersForm' => $this->SchoolPartnersForm(),
            'AgentPartnersForm' => $this->AgentPartnersForm(),
            'SessionMessage' => $this->getSessionMessage(),
            'PreviewPorfileLink' => $this->Link('preview')
        );
         
        $this->data()->Title = sprintf(
			_t('MemberProfiles.MEMBERPROFILETITLE', "%s's Information"),
			$school->Name
		);
        
        $controller = $this->customise($customData);
		return $controller->renderWith(array(
			'SchoolPortalPage_edit', 'Page'
		));
    }
    
    public function preview() {
        if(!Permission::check('EDIT_SCHOOL')) {
            return Security::permissionFailure();
        }
        
        $school = School::currentUser();
		if(!$school) { $this->httpError(404); }
        
        Requirements::javascript('themes/one/javascript/schoolview.js');

        $profileContent = PartnersProfile::get()->byID($school->PartnersProfileID);
        
        //check user has profile page and create if not
        if(!$profileContent) {
            $profileContent = new PartnersProfile();
            $school->PartnersProfileID = $profileContent->write();
            $school->write();
        }
        
		$customData = array(
            'Member' => $school,
            'ProfilePage' => $profileContent,
            'Title' => $school->Name ? $school->Name."'s Profile Page" : 'Profile Page',
            'ApplicationForm' => 'This is where the application form would be.',
            'SessionMessage' => array('Content' => 'This is what students see when looking at your profile', 'Context' => 'warning', 'Title' => 'PROFILE PREVIEW')
        );
        
        $controller = $this->customise($customData);
		return $controller->renderWith(array(
			'SchoolPortalPage_show', 'Page'
		));
    }
    
    public function show() {
        if(!Permission::check('VIEW_SCHOOL')) {
            return Security::permissionFailure();
        }
        
        $id = $this->getRequest()->param('ID');
        
        if(!$id || !ctype_digit($id)) {
            $this->httpError(404);
        }

        $school = School::get()->byID($id);
        if(!$school) {$this->httpError(404);}
        
        $profilePage = PartnersProfile::get()->ByID($school->PartnersProfileID);
		if(!$profilePage) {
			$profilePage = new PartnersProfile();
            $school->ProfilePageID = $profilePage->write();
            $school->write();
		}

		$this->data()->Title = sprintf(
			_t('MemberProfiles.MEMBERPROFILETITLE', "%s's Profile"),
			$school->getName()
		);
        
        $customData = array(
            'Member' => $school,
            'IsSelf' => $school->ID == School::currentUserID(),
            'ProfilePage' => $profilePage,
            'Title' => $school->Name ? $school->Name."'s Profile Page" : 'Profile Page',
            'ApplicationForm' => ApplicationsController::create()->CreateSchoolApplicationForm($id),
            'SessionMessage' => $this->getSessionMessage()
        );
        Requirements::javascript('themes/one/javascript/schoolview.js');

        $controller = $this->customise($customData);
		return $controller->renderWith(array(
			'SchoolPortalPage_show', 'Page'
		));
    }
    
    public function RegisterForm() {
        $fields = new FieldList(
            new LiteralField('BasicInfo', '<h3>Basic Information</h3>'),
            new TextField('Name', 'Name of School<span>*</span>'),
            new TextField('Website', 'School Website<span>*</span>'),
            new EmailField('Email', 'Contact Email<span>*</span>'),
            new TextField('ContactTelephone', 'Contact Phone Number'),
            new TextField('ContactName', 'Name of Contact<span>*</span>'),
            new LiteralField('LiteralHeader', '<h3>Registration Info</h3>'),
            new TextField('RegistrationNumber', 'Registration Number'),
            DropdownField::create('CountryID', 'Country of Registration', Country::getCountryOptions())->setEmptyString('Select a Country')->addExtraClass('chosen-select'),
            ConfirmedPasswordField::create('Password', 'Password')
        );
        
        $actions = FieldList::create(
            FormAction::create('doRegister', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Register'))->addExtraClass('btn btn-primary'),
            LiteralField::create('login', '<a data-toggle="tab" class="btn btn-default" href="#login">Login</a>')
        );
        
        $required = new RequiredFields(array(
            'Name',
            'Email',
            'ContactName',
            'CountryID'
        ));
        
        return new Form($this, 'RegisterForm', $fields, $actions, $required);
    }
    
    public function doRegister(array $data, Form $form) {
        $school = new School();
        
        $form->saveInto($school);
        
        $school->NeedsValidation = false;
        $school->NeedsApproval = true;
        
        try {
			$school->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}
        
        $schoolGroup = DataObject::get_one('Group', "Code='schools'");
        
        if(!$schoolGroup) {
            $schoolGroup = new Group();
            $schoolGroup->Code = "schools";
            $schoolGroup->Title = "Schools";
            $schoolGroup->Description = "All registered schools";
            $LinkedPage = SiteTree::get()->filter(array(
                'ClassName' => 'SchoolPortalPage'))->First();
            $schoolGroup->LinkedPageID = $LinkedPage->ID;
            
            $schoolGroup->Write();
        }
        $schoolGroup->Members()->add($school);
        
        $email = new Email();
        $email
            ->setFrom('noreply@genxyz.ca')
            ->setTo('admin@GenXYZ')
            ->setSubject('New School Registration')
            ->setTemplate('NewSchool')
            ->populateTemplate(new ArrayData(array(
                'Member' => $school,
                'LoginLink' => Director::absoluteURL('admin')
            )));
                
        $email->send();
        
        $customData = array(
            'Content' => 'You have successfully created an account. An agent will verify your account and be in touch with you shortly.',
            'Title' => 'Successfully registered'
        );
        
        return $this->customise($customData)->renderWith(array('Page'));
    }
    
    public function BasicInfoForm() {
        if(!Permission::check('EDIT_SCHOOL')) { 
            return Security::permissionFailure(); 
        }
        
        $school = School::currentUser();
        
        $UploadField = new UploadField('Logo', 'Add your logo');
        $UploadField->setAllowedFileCategories('image');
        $UploadField->setAllowedMaxFileNumber(1);
        $UploadField->setFolderName('schools/'.$school->ID.'/Logo');
        
        $fields = new FieldList(
            new TextField('Name', 'Business Name<span>*</span>'),
            new TextField('Website', 'Website<span>*</span>'),
            $UploadField,
            new LiteralField('ContactInfo', '<h2>Contact Info</h2>'),
            new TextField('ContactName', 'Contact Name<span>*</span>'),
            new EmailField('Email', 'Contact Email<span>*</span>'),
            new TextField('ContactTelephone', 'Contact Phone<span>*</span>'),
            new TextField('Established', 'Established'),
            new TextField('City', 'City'),
            DropdownField::create('Type', 'Type of School', singleton('School')->dbObject('Type')->enumValues())->setEmptyString('Select the type of your school')->addExtraClass('chosen-select'),
            DropdownField::create('SchoolSize', 'Size of School', singleton('School')->dbObject('SchoolSize')->enumValues())->setEmptyString('Select the size of your school')->addExtraClass('chosen-select'),
            new LiteralField('LiteralHeader', '<h2>Registration Info</h2>'),
            new TextField('RegistrationNumber', 'Registration Number'),
            DropdownField::create('CountryID', 'Country of Registration', Country::getCountryOptions())->setEmptyString('Select a Country')->addExtraClass('chosen-select'),
            ConfirmedPasswordField::create('Password', 'Password', "", null, true),
            new HiddenField('ID', 'ID')
        );
        
        $actions = FieldList::create(
            FormAction::create('saveBasicInfo', 'Save')->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'Name',
            'Email',
            'ContactName',
            'ContactTelephone',
            'CountryID'
        ));
        
        return new Form($this, 'BasicInfoForm', $fields, $actions, $required);
    }
    
    public function saveBasicInfo(array $data, Form $form) {
        if(!Permission::check('EDIT_SCHOOL')) {
            return Security::permissionFailure();
        }
                
        $member = Member::currentUser();
        $form->saveInto($member);
        
        try {
			echo $member->write();
		} catch(ValidationException $e) {
            Session::set('SessionMessage', $e->getResult()->message());
            Session::set('SessionMessageContext', 'danger');
        
			return $this->owner->redirectBack();
		}
        
        Session::set('SessionMessage', 'Your information has been updated and saved.');
        Session::set('SessionMessageContext', 'success');
        
        return $this->redirectBack();
    }
    
    public function ProfileLinksForm() {
        $imageOne = new UploadField('SlideOne', 'Upload the first slide for your slideshow.');
        $imageOne->setAllowedFileCategories('image');
        $imageOne->setAllowedMaxFileNumber(1);
        $imageOne->setFolderName('schools/'.School::currentUserID().'/Slides');
        
        $imageTwo = new UploadField('SlideTwo', 'Upload the second slide for your slideshow.');
        $imageTwo->setAllowedFileCategories('image');
        $imageTwo->setAllowedMaxFileNumber(1);
        $imageTwo->setFolderName('schools/'.School::currentUserID().'/Slides');
        
        $imageThree = new UploadField('SlideThree', 'Upload the third slide for your slideshow.');
        $imageThree->setAllowedFileCategories('image');
        $imageThree->setAllowedMaxFileNumber(1);
        $imageThree->setFolderName('schools/'.School::currentUserID().'/Slides');
        
        $fields = new FieldList(
            $imageOne->addExtraClass('inline'),
            $imageTwo->addExtraClass('inline'),
            $imageThree->addExtraClass('inline'),
            new TextField('ProfileColour', 'Enter the RGB Hex value of the colour you want your profile to be. (ie. FF0000 for Red.)'),
            new TextareaField('AboutSchool', 'About University'),
            new LiteralField('Description', '<h5>Provide links to general pages with the information required.</h5>'),
            new TextField('ContactInfo', 'Contact Information'),
            new TextField('Scholarships', 'Scholarships'),
            new LiteralField('Description', '<h5>Provide links to the following documents. Requiremments may vary depending on program.</h5>'),
            new TextField('AdmissionRequirements', 'General Admission Requirements'),
            new TextField('EnglishRequirements', 'General English Requirements'),
            new TextField('ProcessingTime', 'Estimated Processing Time'),
            new TextField('Fees', 'Approximate Tuition Fees')
        );
        
        $actions = FieldList::create(
            FormAction::create('saveProfilePage', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'SlideOne',
            'SlideTwo',
            'SlideThree',
            'About'
        ));
        
        return new Form($this->owner, 'ProfileLinksForm', $fields, $actions, $required);
    }
    
    public function saveProfilePage(array $data, Form $form) {
        if(!Permission::check('EDIT_SCHOOL')) {
            return Security::permissionFailure();
        }
        
        $school = School::currentUser();
                
        $profilePage = PartnersProfile::get()->byID($school->PartnersProfileID);
        
        if(!$profilePage) {
            $profilePage = new ProfilePage();
            $school->PartnersProfileID = $profilePage->ID;
            try {
                $school->write();
            } catch(ValidationException $e) {
                Session::set('SessionMessage', $e->getResult()->message());
                Session::set('SessionMessageContext', 'danger');

                return $this->owner->redirectBack();
            }
        }
        $form->saveInto($profilePage);

        try {
			$profilePage->write();
		} catch(ValidationException $e) {
			Session::set('SessionMessage', $e->getResult()->message());
            Session::set('SessionMessageContext', 'danger');
            
			return $this->owner->redirectBack();
		}
        
        Session::set('SessionMessage', 'Your profile has been saved successfully.');
        Session::set('SessionMessageContext', 'success');

        return $this->redirectBack();
    }
    
    public function AddProgramForm() {
        $school = School::currentUser();
        
        $schoolPrograms = $school->Programs();
        $FilterList = array();
        foreach($schoolPrograms as $program)
            $FilterList[] = $program->ProgramNameID;

        $programs = ProgramName::get()->exclude('ID',$FilterList)->map('ID','Name');

        
        $fields = new FieldList(
            new LiteralField('AddProgram', '<h2>Add A New Program</h2>'),
            DropdownField::create(
                'ProgramNameID', 
                'Select the program you would like to add.',
                $programs)->addExtraClass('chosen-select')->setEmptyString('Select program to add.'),
            TextField::create('CertificateLink', 'Link to Program\'s Certification'),
            TextField::create('DiplomaLink', 'Link to Program\'s Diploma'),
            TextField::create('DegreeLink', 'Link to Program\'s Degree'),
            TextField::create('MastersLink', 'Link to Program\'s Masters'),
            TextField::create('DoctorateLink', 'Link to Program\'s Doctorate')
        );
        
        $actions = FieldList::create(
            FormAction::create('addProgram', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Add'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'ProgramNameID'
        ));
        
        return new Form($this->owner, 'AddProgramForm', $fields, $actions, $required);
    }
    
    public function addProgram(array $data, Form $form) {
        if(!Permission::check('EDIT_SCHOOL')) {
            return Security::permissionFailure();
        }
        
        $program = new Program();
        $form->saveInto($program);
        $program->SchoolID = Member::currentUserID();
        
        try {
			$program->write();
		} catch(ValidationException $e) {
			Session::set('SessionMessage', $e->getResult()->message());
            Session::set('SessionMessageContext', 'danger');   
			return $this->owner->redirectBack();
		}
                
        Session::set('SessionMessage', 'Your have added a '.$program->ProgramName->Name.' program to your profile.');
        Session::set('SessionMessageContext', 'success');

        return $this->redirectBack();
    }
    
    public function EditProgramForm($member = null) {
        $member = Member::currentUser();
        
        if($member->Programs()) {
            $programs = $member->Programs()->map('ID', 'Title', 'Please Select');
        } else {
            $programs = array();
        }
            
        $fields = new FieldList(
            new LiteralField('EditPrograms', '<h2>Edit Your Programs</h2>'),
            DropdownField::create('ProgramID', 'Edit Your Programs', $programs)->setEmptyString('Select a program to edit.')->addExtraClass('edit-program-select chosen-select')->setAttribute('data-ajax-link', $this->Link('ajaxProgramRequest')),
            TextField::create('CertificateLink', 'Link to Program\'s Certification')->addExtraClass('CertificateLink'),
            TextField::create('DiplomaLink', 'Link to Program\'s Diploma')->addExtraClass('DiplomaLink'),
            TextField::create('DegreeLink', 'Link to Program\'s Degree')->addExtraClass('DegreeLink'),
            TextField::create('MastersLink', 'Link to Program\'s Masters')->addExtraClass('MastersLink'),
            TextField::create('DoctorateLink', 'Link to Program\'s Doctorate')->addExtraClass('DoctorateLink')
        );
        
        $actions = FieldList::create(
            FormAction::create('editProgram', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save'))->addExtraClass('btn btn-default'),
            FormAction::create('deleteProgram', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Delete'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'ProgramName'
        ));
        
        return new Form($this->owner, 'EditProgramForm', $fields, $actions, $required);
    }
    
    public function editProgram(array $data, Form $form) {
        if(!Permission::check('EDIT_SCHOOL')) {
            return Security::permissionFailure();
        }
        
        $program = Program::get()->byID($data['ProgramID']);
        
        if(!$program || $program->SchoolID != Member::currentUserID()) {
            Session::set('SessionMessage', 'You cannot edit this program. Select a different program and try again.');
            Session::set('SessionMessageContext', 'danger');
            return $this->redirectBack();
        }

        $form->saveInto($program);
            
        try {
			$program->write();
		} catch(ValidationException $e) {
            Session::set('SessionMessage', $e->getResult()->message());
            Session::set('SessionMessageContext', 'danger');
			return $this->owner->redirectBack();
		}
                
        Session::set('SessionMessage', 'Your program, '.$program->ProgramName->Name.', has been updated and saved.');
        Session::set('SessionMessageContext', 'success');

        return $this->redirectBack();
    }
    
    public function deleteProgram(array $data, Form $form) {
        if(!Permission::check('EDIT_SCHOOL')) {
            return Security::permissionFailure();
        }
        
        $program = Program::get()->byID($data['ProgramID']);
        
        if(!$program || $program->SchoolID != Member::currentUserID()) {
            Session::set('SessionMessage', 'You cannot delete this program.');
            Session::set('SessionMessageContext', 'danger');
            return $this->redirectBack();
        }
        
        $program->delete();
        Session::set('SessionMessage', 'You have deleted your program: '.$program->ProgramName->Name);
        Session::set('SessionMessageContext', 'success');
        
        return $this->redirectBack();
    }
    
    public function AgentPartnersForm() {
        if(!Permission::check('EDIT_SCHOOL')) { 
            return Security::permissionFailure(); 
        }
        
        $school = School::currentUser();
        
        $items = Agent::get()->map('ID', 'Name', '--Select agencies--')->toArray();
        $current = array();
        foreach($school->Agents() as $agent) {
            $current[] = $agent->ID;
        }
        
        $fields = new FieldList(
            new LiteralField('AgentPartners', 'Select the agents you have agreements with.'),
            ListboxField::create('Agents', 'Agents')->setMultiple(true)->setSource($items)->setValue($current)->addExtraClass('chosen-select')
        );
        
        $actions = FieldList::create(
            FormAction::create('saveAgentPartners', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'Agents'
        ));
        
        return new Form($this->owner, 'AgentPartnersForm', $fields, $actions, $required);
    }
    
    public function saveAgentPartners(array $data, Form $form) {
        if(!Permission::check('EDIT_SCHOOL')) {
            return Security::permissionFailure();
        }
        $school = School::currentUser();
        
        $current = array();
        foreach($school->Agents() as $agent) {
            $current[] = $agent->ID;
        }
        
        $toAdd = array_diff($data['Agents'], $current);
        $toRemove = array_diff($current, $data['Agents']);
        
        $addedString = '';
        $removedString = '';
        
        foreach($toAdd as $add) {
            $agent = Agent::get()->byID($add);
            if(!$agent) { continue; }
            
            $school->Agents()->add($agent);
            $addedString .= $agent->Name;
        }
        foreach($toRemove as $remove) {
            $agent = Member::get()->byID($remove);
            if(!$agent) { continue; }
            
            $school->Agents()->remove($agent);  
            $removedString .= $agent->Name . ' ';            
        }
        
        $returnString = '';

        if($removedString) { $returnString .= 'You removed: '. $removedString; } 
        if($addedString) { $returnString .= ' / You added: '. $addedString; }
        if($returnString=='') {$returnString = 'No changes were made.';}
        Session::set('SessionMessage', $returnString);
        Session::set('SessionMessageContext', 'success');


        $this->redirectBack();
    }
    
    public function SchoolPartnersForm($id = 0) {
        if(!Permission::check('EDIT_SCHOOL')) {
            return Security::permissionFailure();
        }
        $school = School::currentUser();
        
        $items = School::get()->map('ID', 'Name', '--Select schools--')->toArray();
        $current = array();
        foreach($school->Schools() as $schools) {
            $current[] = $schools->ID;
        }
        
        $fields = new FieldList(
            new LiteralField('School Partners', 'Select the schools you have an articulation agreement with.'),
            ListboxField::create('Schools', 'Schools')->setMultiple(true)->setSource($items)->setValue($current)->addExtraClass('chosen-select'),
            new HiddenField('MemberID', 'MemberID', $id)
        );
        
        $actions = FieldList::create(
            FormAction::create('saveSchoolPartners', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'Schools'
        ));
        
        return new Form($this->owner, 'SchoolPartnersForm', $fields, $actions, $required);
    }
    
    public function saveSchoolPartners(array $data, Form $form) {
        if(!Permission::check('EDIT_SCHOOL')) {
            return Security::permissionFailure();
        }
        $school = School::currentUser();
        
        $current = array();
        foreach($school->Schools() as $partner) {
            $current[] = $partner->ID;
        }
        
        $toAdd = array_diff($data['Schools'], $current);
        $toRemove = array_diff($current, $data['Schools']);
        
        $addedString = '';
        $removedString = '';
        
        foreach($toAdd as $add) {
            $partner = School::get()->byID($add);
            if(!$partner) { continue; }
            
            $school->Schools()->add($partner);
            $partner->Schools()->add($school);
            $addedString .= $partner->Name . ' ';
        }
        foreach($toRemove as $remove) {
            $partner = School::get()->byID($remove);
            if(!$partner) { continue; }
            
            $school->Schools()->remove($partner);
            $partner->Schools()->remove($school);
            $removedString .= $partner->Name . ' ';            
        }
        
        $returnString = '';

        if($removedString) { $returnString .= 'You removed: '. $removedString; } 
        if($addedString) { $returnString .= ' / You added: '. $addedString; } 
        Session::set('SessionMessage', $returnString);
        Session::set('SessionMessageContext', 'success');


        $this->redirectBack();
    }
    
    public function ajaxProgramRequest($message = "", $extraData = null, $status = 'success') {
        $this->response->addHeader('Content-Type', 'application/json');
        SSViewer::set_source_file_comments(false);
        
        if($status != 'success') {
            $this->setStatusCode(400, $message);
        }

        $js = array();

        if(!isset($_GET['ProgramID']) || !ctype_digit($_GET['ProgramID'])) {
              return json_encode(array(
                  'error' => 'Invalid argument.',
                  'value' => 'error'
              ));
        }
        
        $program = Program::get()->byID($_GET['ProgramID']);
        
        if(!$program) {
            return json_encode(array(
                'error'=>'Program not found',
                'value'=>'error'
            ));
        } else if($program->SchoolID != Member::currentUserID()) {
            return json_encode(array(
                'error'=>'You cannot access this program',
                'value'=>'error'
            ));
        }
                  
        $js[] = array(
            'title' => 'CertificateLink',
            'value' => $program->CertificateLink ? $program->CertificateLink : '');
            $js[] = array(
            'title' => 'DiplomaLink',
            'value' => $program->DiplomaLink ? $program->DiplomaLink : '');
        $js[] = array(
            'title' => 'DegreeLink',
            'value' => $program->DegreeLink ? $program->DegreeLink : '');
        $js[] = array(
            'title' => 'MastersLink',
            'value' => $program->MastersLink ? $program->MastersLink : '');
        $js[] = array(
            'title' => 'DoctorateLink',
            'value' => $program->DoctorateLink ? $program->DoctorateLink : '');
        
        return json_encode($js);
    }
    
    public function rateschool()
    {
        if(!Permission::check('VIEW_SCHOOL')) {
            return Security::permissionFailure();
        }
        
        if( $this->GetRequest()->param('OtherID') == null 
            || !ctype_digit($this->GetRequest()->param('OtherID')) 
            || ($this->GetRequest()->param('ID') == null) 
            || !ctype_digit($this->GetRequest()->param('ID')) ) {
            return json_encode(array(
                'responsetext' => 'Invalid arguments',
                'value' => 'error'
            ));
        }
        
        $school = School::get()->byID($this->GetRequest()->param('ID'));
                                      
        if(!$school) return json_encode(array('value'=>'error','responsetext'=>'School not found.'));
        
        $rating = Rating::get()->filter(array(
            'RaterID' => Student::currentUser()->ID,
            'RateeID' => $this->GetRequest()->param('ID')
        ))->First();
        
        if($rating) {
            $rating->Value = $this->GetRequest()->param('OtherID');
            $rating->Content = urldecode($_GET['reviewcontent']);
            $rating->write();
            return json_encode(array(
                'responsetext' => 'Your rating has been changed for this school.',
                'value' => 'error'
            ));
        }
        
        $rating = new Rating();
        $rating->RaterID = Student::currentUser()->ID;
        $rating->RateeID = $this->GetRequest()->param('ID');
        $rating->Value = $this->GetRequest()->param('OtherID');
        $rating->Content = urldecode($_GET['reviewcontent']);
        $rating->write();
        
        return json_encode(array(
            'value' => 'success',
            'responsetext' => 'You rated this school.'
        ));
    }
}