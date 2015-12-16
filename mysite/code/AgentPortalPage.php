<?php

class AgentPortalPage extends Page 
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

class AgentPortalPage_Controller extends Page_Controller 
{
    private static $allowed_actions = array(
        'RegisterForm',
        'doRegister',
        'edit',
        'search',
        'BasicInfoForm',
        'SchoolPartnersForm',
        'saveSchoolPartners',
        'AddServiceForm',
        'EditServiceForm',
        'addService',
        'editService',
        'deleteService',
        'SchoolPartnersForm',
        'saveSchoolPartners',
        'SchoolApplicationEditForm',
        'ajaxServiceRequest'
    );
    
    private static $url_handlers = array(
        'search/$Country/$Service' => 'search'
    );
    
    protected $FilterAgents;
        
    function init() {        
        parent::init();
        
        Requirements::set_force_js_to_bottom(true);
        Requirements::javascript("themes/one/javascript/agentedit.js");
        Requirements::javascript(
            FRAMEWORK_DIR."/admin/thirdparty/chosen/chosen/chosen.jquery.js");
        Requirements::css(
            FRAMEWORK_DIR."/admin/thirdparty/chosen/chosen/chosen.css");
    }
    
    public function index() {
        if(Permission::check('EDIT_AGENT')) {
            $this->redirect($this->Link('edit'));
        }
        
        $customData = array(
            'RegisterForm' => $this->RegisterForm(),
            'Title' => 'Agents',
            'BrowseLink' => $this->Link('search')
        );
        
        return $this->customise($customData)->renderWith(array('PortalPage','Page'));
    }
    
    public function search() {
        if(!isset($this->FilterAgents)) {
            $this->FilterAgents = SearchPage_Controller::create()->FilterAgents();
        }
        
        $filter = array();
        $ids = array();
        if( ($this->getRequest()->param('Country') != '0') &&
           ctype_digit($this->getRequest()->param('Country')) ) {
            $filter['CountryID'] = $this->getRequest()->param('Country');
        }
        if( ($this->getRequest()->param('Service') != '0') &&
           ctype_digit($this->getRequest()->param('Service')) ) {
            $ids = Service::get()->filter(array(
                'ServiceName.ID' => $this->getRequest()->param('Service')
            ))->column('AgentID');
            
            if($ids) {
                $filter['ID'] = $ids;
            }
        }
        
        if($ids || $this->getRequest()->param('Service') == null ||
            $this->getRequest()->param('Service') == '0') {
            $agents = Agent::get()->filter($filter);
            $paginated = PaginatedList::create($agents, $this->getRequest())->setPageLength(12);
        } else {
            $paginated = false;
        }

        if(Director::is_ajax()) {
            return $this->renderWith('AgentResults', ['PaginatedResults' => $paginated]);
        }
        
        Requirements::javascript("themes/one/javascript/jquery.bootpag.min.js");
        Requirements::javascript("themes/one/javascript/searchpage.js");
        
        $customData = array(
            'PaginatedResults' => $paginated,
            'Title' => 'Agent search results',
            'Content' => 'Browse our agents.',
            'SearchPageLink' => SearchPage::get()->First()->Link(),
            'AgentFilter' => $this->FilterAgents
        );
        
        return $this->customise($customData)->renderWith(array(
            'AgentPortalPage_search','Page'
        ));
    }
    
    public function edit() {
        if(!Permission::check('EDIT_AGENT')) {
            return Security::permissionFailure();
        }
        
        $agent = Agent::currentUser();
        
        $customData = array(
            'Member' => $agent,
            'menuShown' => 'None',
            'BasicInfo' => $this->BasicInfoForm()->loadDataFrom($agent),
            'AddServices' => $this->AddServiceForm(),
            'EditServices' => $this->EditServiceForm(),
            'SchoolPartnersForm' => $this->SchoolPartnersForm(),
            'AddMessageForm' => MessagingController::create()->AddMessageForm($agent->MessageThreads()->First()->ID),
            'SessionMessage' => $this->getSessionMessage(),
            'Title' => $agent->Name . '\'s Profile'
        );

        $controller = $this->customise($customData);
		return $controller->renderWith(array(
			'AgentPortalPage_edit', 'Page'
		));
    }
    
    public function RegisterForm() {
        $fields = new FieldList(
            new LiteralField('ContactInfo', '<h3>' . _t(
                'AcademicsRegisterForm.CONTACT',
                'Contact Info') . '</h3>'),
            new TextField('FirstName', 'First Name<span>*</span>'),
            new TextField('Surname', 'Last Name<span>*</span>'),
            new EmailField('Email', 'Contact Email<span>*</span>'),
            DropdownField::create('CountryID', 'Country of Registration', Country::getCountryOptions())->setEmptyString('Select Your Country')->addExtraClass('chosen-select'),
            ConfirmedPasswordField::create('Password', 'Password')
        );
        
        $actions = FieldList::create(
            FormAction::create('doRegister', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Register'))->addExtraClass('btn btn-primary'),
            LiteralField::create('login', '<a data-toggle="tab" class="btn btn-default" href="#login">Login</a>')
        );
        
        $required = new RequiredFields(array(
            'FirstName',
            'Surname',
            'Email',
        ));
        
        return new Form($this->owner, 'RegisterForm', $fields, $actions, $required);
    }
    
    public function doRegister(array $data, Form $form) {
        $agent = new Agent();
        
        $form->saveInto($agent);
        
        $agent->NeedsValidation = false;
        $agent->NeedsApproval = true;
        $agent->ValidationKey = 0;
        
        try {
			$agent->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return;
		}
        
        $agentGroup = DataObject::get_one('Group', "Code='agents'");
        
        if(!$agentGroup) {
            $agentGroup = new Group();
            $agentGroup->Code = "agents";
            $agentGroup->Title = "Agents";
            $agentGroup->Description = "All registered agents";
            $LinkedPage = SiteTree::get()->filter(array(
                'ClassName' => 'AgentPortalPage'))->First();
            $agentGroup->LinkedPageID = $LinkedPage->ID;
            
            $agentGroup->Write();
        }
        $agentGroup->Members()->add($agent);
        
        $email = new Email();
        $email
            ->setFrom('noreply@genxyz.ca')
            ->setTo('admin@genxyz.ca')
            ->setSubject('New Agent Registration')
            ->setTemplate('NewAgent')
            ->populateTemplate(new ArrayData(array(
                'Member' => $agent,
                'LoginLink' => Director::absoluteURL('admin')
            )));
                
        $email->send();
        
        //returned page
        $customData = array(
            'Content' => 'You have successfully created an account. A GenXYZ representative will validate your account information and then contact you shortly to give you your account details.',
            'Title' => 'Successfully registered'
        );
        
        return $this->customise($customData)->renderWith(array('Page'));
    }
    
    public function BasicInfoForm() {
        if(!Permission::check('EDIT_AGENT')) { return Security::permissionFailure(); }
        
        $agent = Agent::currentUser();
        
        $UploadField = new UploadField('Logo', 'Add your logo');
        $UploadField->setAllowedFileCategories('image');
        $UploadField->setAllowedMaxFileNumber(1);
        $UploadField->setFolderName('agents/'.$agent->ID.'/Logos');
        
        $fields = new FieldList(
            new TextField('FirstName', 'First Name<span>*</span>'),
            new TextField('Surname', ' Last Name<span>*</span>'),
            new TextField('Website', 'Website<span>*</span>'),
            new TextAreaField('AboutMe', 'Write a little bit about yourself. (Max 200 characters!)'),
            $UploadField,
            DropdownField::create('NationalityID', 'Nationality', Country::getCountryOptions())->setEmptyString('Select a Country')->addExtraClass('country-select-dropdown chosen-select'),
            new LiteralField('ContactInfo', '<h2>' . _t(
                'AcademicsRegisterForm.CONTACT',
                'Contact Info') . '</h2>'),
            new EmailField('Email', 'Contact Email<span>*</span>'),
            new PhoneNumberField('PhoneNumber', 'Phone Number (with no separators)'),
            new TextField('AddressLine1', 'Address Line 1'),
            new TextField('AddressLine2', 'Address Line 2'),
            new TextField('City', 'City'),
            new TextField('PostalCode', 'Postal/Zip Code'),
            DropdownField::create('CountryID', 'Country of Residence', Country::getCountryOptions())->setEmptyString('Select a Country')->addExtraClass('country-select-dropdown chosen-select'),
            ConfirmedPasswordField::create('Password', 'Password', "", null, true),
            new HiddenField('ID', 'ID')
        );
        
        $actions = FieldList::create(
            FormAction::create('saveBasicInfo', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'Name',
            'ContactName',
            'ContactTelephone',
            'RegistrationNumber'
        ));
        
        return new Form($this->owner, 'BasicInfoForm', $fields, $actions, $required);
    }
    
    public function saveBasicInfo(array $data, Form $form) {
        if($data['ID'] != Member::currentUserID() ||
           !Permission::check('EDIT_AGENT')) {
            $this->httpError(403);
        }
                
        $agent = Agent::currentUser();
        $form->saveInto($agent);
        
        try {
			$agent->write();
		} catch(ValidationException $e) {
            Session::set('SessionMessage', $e->getResult()->message());
            Session::set('SessionMessageContext', 'danger');
			return $this->owner->redirectBack();
		}
        
            Session::set('SessionMessage', 'Your information has been updated and saved!');
            Session::set('SessionMessageContext', 'success');     
            return $this->redirectBack();
    }
    
    public function AddServiceForm($member = null) {
        $agent = Agent::currentUser();
               
        $agentServices = $agent->Services();
        $FilterList = array();
        foreach($agentServices as $service)
            $FilterList[] = $service->ServiceNameID;

        $services = ServiceName::get()->exclude('ID',$FilterList)->map('ID','Name');

        
        $fields = new FieldList(
            new LiteralField('AddService', '<h2>Add A New Service</h2>'),
            DropdownField::create(
                'ServiceNameID', 
                'Select the service you would like to add.',
                $services)->setEmptyString('Select service to add.'),
            TextAreaField::create('Description', 'A description of the service'),
            NumericField::create('Cost', 'The cost of the service')
        );
        
        $actions = FieldList::create(
            FormAction::create('addService', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Add'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'ServiceNameID'
        ));
        
        return new Form($this->owner, 'AddServiceForm', $fields, $actions, $required);
    }
    
    public function addService(array $data, Form $form) {
        if(!Permission::check('EDIT_AGENT')) {
            return Security::permissionFailure();
        }        
        $service = new Service();
        $form->saveInto($service);
        $service->AgentID = Member::currentUserID();
        
        try {
			$service->write();
		} catch(ValidationException $e) {
			Session::set('SessionMessage', $e->getResult()->message());
            Session::set('SessionMessageContext', 'danger'); 
			return $this->owner->redirectBack();
		}
                
        Session::set('SessionMessage', 'You added '.$service->getTitle().' as a service you provide. Students can now contact you to request this service.');
        Session::set('SessionMessageContext', 'success');
        return $this->redirectBack();
    }
    
    public function EditServiceForm($member = null) {
        $member = Member::currentUser();
        
        if($member->Services()) {
            $service = $member->Services()->map('ID', 'Title', 'Please Select');
        } else {
            $service = array('empty', 'Add services before you can edit them.');
        }
            
        $fields = new FieldList(
            new LiteralField('EditService', '<h2>Edit Your Services</h2>'),
            DropdownField::create('ServiceID', 'Edit Your Service', $service)->setEmptyString('Select a service to edit.')->addExtraClass('edit-service-select'),
            TextAreaField::create('Description', 'A description of your service')->addExtraClass('DescriptionField'),
            NumericField::create('Cost', 'The cost of your service')->addExtraClass('CostField')
        );
        
        $actions = FieldList::create(
            FormAction::create('editService', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save'))->addExtraClass('btn btn-primary'),
            FormAction::create('deleteService', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Delete'))->addExtraClass('btn btn-default')
        );
        
        $required = new RequiredFields(array(
            'ServiceID'
        ));
        
        return new Form($this->owner, 'EditServiceForm', $fields, $actions, $required);
    }
    
    public function editService(array $data, Form $form) {
        if(!Permission::check('EDIT_AGENT')) {
            return Security::permissionFailure();
        }        
        $service = Service::get()->byID($data['ServiceID']);
        
        if(!$service || $service->AgentID != Member::currentUserID()) {
            $form->addErrorMessage('Blurb', 'That service was not found. Select a new service and try again.', 'Bad');
            Session::set('SessionMessage', 'That service was not found. Select a new service and try again.');
            Session::set('SessionMessageContext', 'danger');
            return $this->redirectBack();
        }

        $form->saveInto($service);
            
        try {
			$service->write();
		} catch(ValidationException $e) {
			Session::set('SessionMessage', $e->getResult()->message());
            Session::set('SessionMessageContext', 'danger');   
			return $this->owner->redirectBack();
		}
                
        Session::set('SessionMessage', 'You updated your services. '.$service->getTitle().' has been saved.');
        Session::set('SessionMessageContext', 'success');
        return $this->redirectBack();
    }
    
    public function deleteService(array $data, Form $form) {
        if(!Permission::check('EDIT_AGENT')) {
            return Security::permissionFailure();
        }

        $service = Service::get()->byID($data['ServiceID']);
        
        if(!$service || $service->AgentID != Member::currentUserID()) {
            Session::set('SessionMessage', 'You don\'t have access to that service.');
            Session::set('SessionMessageContext', 'warning');
            return $this->redirectBack();
        }
        
        Session::set('SessionMessage', 'Your services have been updated and you no longer provide '.$service->getTitle().'.');
        Session::set('SessionMessageContext', 'success');
        $service->delete();
        
        return $this->redirectBack();
    }
    
    public function SchoolPartnersForm($id = 0) {
        $member = Member::currentUser();
        if(!$member) { return Security::permissionFailure(); }
        
        $items = School::get()->map('ID', 'Name')->toArray();
        $current = array();
        foreach($member->Schools() as $schools) {
            $current[] = $schools->ID;
        }
        
        $fields = new FieldList(
            new LiteralField('School Partners', 'Select the schools you would like to partner with.'),
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
        $member = Member::currentUser();
        if(!Permission::check('EDIT_AGENT')) { return Security::permissionFailure(); }
        
        $current = array();
        foreach($member->Schools() as $school) {
            $current[] = $school->ID;
        }
        
        $toAdd = array_diff($data['Schools'], $current);
        $toRemove = array_diff($current, $data['Schools']);
        
        $addedString = '';
        $removedString = '';
        
        foreach($toAdd as $add) {
            $school = School::get()->byID($add);
            if(!$school) { continue; }
            
            $member->Schools()->add($school);
            if($member->ClassName == "Agent") {
                $school->Agents()->add($member);
            }
            $addedString .= $school->Name;
        }
        foreach($toRemove as $remove) {
            $school = School::get()->byID($remove);
            if(!$school) { continue; }
            
            $member->Schools()->remove($school);
            if($member->ClassName == "Agent") {
                $school->Agents()->remove($member);
            }
            $removedString .= $school->Name . ' ';            
        }
        
        $returnString = '';

        if($removedString) { $returnString .= 'You removed: '. $removedString; } 
        if($addedString) { $returnString .= ' / You added: '. $addedString; } 
        $form->addErrorMessage('Blurb', $returnString, 'Good');

        $this->redirectBack();
    }
        
    public function ajaxServiceRequest($message = "", $extraData = null, $status = 'success') {
        $this->response->addHeader('Content-Type', 'application/json');
        SSViewer::set_source_file_comments(false);
        
        if($status != 'success') {
            $this->setStatusCode(400, $message);
        }

        $js = array();

        if(!isset($_GET['ServiceID']) || !ctype_digit($_GET['ServiceID'])) {
              return json_encode(array(
                  'error' => 'Invalid argument.',
                  'value' => 'error'
              ));
        }
        
        $service = Service::get()->byID($_GET['ServiceID']);
        
        if(!$service) {
            return json_encode(array(
                'error'=>'Service not found',
                'value'=>'error'
            ));
        } else if($service->AgentID != Member::currentUserID()) {
            return json_encode(array(
                'error'=>'You cannot access this service',
                'value'=>'error'
            ));
        }
                  
        $js[] = array(
            'title' => 'DescriptionField',
            'value' => $service->Description ? $service->Description : '');
        $js[] = array(
            'title' => 'CostField',
            'value' => $service->Cost ? $service->Cost : '');
        
        return json_encode($js);
    }
    
}