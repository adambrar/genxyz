<?php 
 
class PartnersPortalPage extends Page 
{
    private static $db = array(
        'Message' => 'Text',
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
 
class PartnersPortalPage_Controller extends Page_Controller 
{
    private static $allowed_actions = array(
        'EditForm',
        'edit',
        'saveBasicInfo',
        'register',
        'RegisterForm',
        'doRegister',
        'BasicInfoForm',
        'ProfileLinksForm',
        'InstitutionProfileContentForm',
        'AgentProfileContentForm',
        'AgentPartnersForm',
        'saveAgentPartners',
        'SchoolPartnersForm',
        'saveSchoolPartners',
        //Program Permissions
        'AddAcademicProgramsForm',
        'EditAcademicProgramsForm',
        'saveProfilePage',
        'addAcademicProgram',
        'editAcademicPrograms',
        'deleteAcademicProgram',
        'ajaxProgramRequest',
        //Service Permissions
        'AddAcademicServiceForm',
        'EditAcademicServiceForm',
        'addAcademicService',
        'editAcademicService',
        'deleteAcademicService',
        'ajaxServiceRequest'
    );
    
    private static $url_handlers = array(
        'university/$MemberID' => 'edit',
        'agent/$MemberID' => 'edit'
    );
    
    function init() {        
        parent::init();
        
	Requirements::css(FRAMEWORK_DIR . "/admin/thirdparty/chosen/chosen/chosen.css");
        
//        if(!Member::currentUserID() || Member::currentUser()->isStudent()) {
//            Security::permissionFailure(null, 'You need to be logged into a partner profile to view this content.');
//        }
    }
    
    public function edit() {
        $member = Member::currentUser();
        if(!$member || !$member->isAgent() || $member->isUniversity()) {
            Security::permissionFailure(null, 'You need to be logged into a partner profile to edit your profile.');
        }

        return new AcademicsProfileEditor($this, 'edit');
    }
    
    public function register() {
        $data = array(
            'Form' => $this->RegisterForm()
        );
        
        return $this->customise($data)->renderWith(array('Page'));
    }
    
    public function RegisterForm() {
        $fields = new FieldList(
            DropdownField::create('MemberType', _t(
                'MemberProfileForms.BUSINESSTYPE',
                'Type of Business') . '<span>*</span>', array(
                    'Agent' => 'Agency',
                    'University' => 'Educational Institution'
                    ))->setEmptyString('Select Level'),
            new TextField('BusinessName', 'Business Name<span>*</span>'),
            new TextField('BusinessWebsite', 'Website<span>*</span>'),
            new LiteralField('LiteralHeader', '<h1>' . _t(
                'AcademicsRegisterForm.CONTACT',
                'Contact Info') . '</h1>'),
            new TextField('BusinessContact', 'Contact Name<span>*</span>'),
            new EmailField('Email', 'Contact Email<span>*</span>'),
            new TextField('BusinessTelephone', 'Contact Phone'),
            new LiteralField('LiteralHeader', '<h1>' . _t(
                'AcademicsRegisterForm.DEFAULT',
                'Registration Info') . '</h1>'),
            new TextField('BusinessRegistrationNumber', 'Business Registration Number'),
            DropdownField::create('BusinessCountryID', _t(
            'AcademicsRegisterForm.COUNTRY', 
            'Country of Registration'))->setEmptyString('Select a Country')->addExtraClass('country-select-dropdown'),
            new ConfirmedPasswordField('Password', 'Password')
        );
        
        $actions = FieldList::create(
            FormAction::create('doRegister', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Register'))
        );
        
        $required = new RequiredFields(array(
            'BusinessType',
            'BusinessName',
            'ContactName',
            'Email',
            'RegistrationNumber',
            'Password'
        ));
        
        return new Form($this->owner, 'RegisterForm', $fields, $actions, $required);
    }
    
    public function doRegister(array $data, Form $form) {
        
        if(!$data['MemberType']) {
            $form->addErrorMessage('BusinessType', 'Please pick a business type!', 'Bad');
            $form->loadDataFrom($data);
            return $this->redirectBack();
        }
        
        $member = new Member();
        
		$form->saveInto($member);
        
        $member->PartnersProfileID = $this->createProfilePage();
        $member->NeedsValidation = true; 
        
        try {
			$member->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}
        
        $group = null;

        if($data['MemberType'] =='University') {
            $group = Group::get()->filter('Code', 'institutions')->First();
            if(!$group)
            {
                $group = new Group();
                $group->Code = "institutions";
                $group->Title = "Institutions";
                $group->Description = "All registered education institutions";
                $LinkedPage = SiteTree::get()->filter(array(
                    'ClassName' => 'AcademicsPortalPage'
                ))->First();
                $group->LinkedPageID = $LinkedPage->ID;

                $group->Write();
            }
        } else if($data['MemberType'] == 'Agent') {
            $group = Group::get()->filter('Code', 'agencies')->First();
            if(!$group)
            {
                $group = new Group();
                $group->Code = "agencies";
                $group->Title = "Agencies";
                $group->Description = "All registered education institutions";
                $LinkedPage = SiteTree::get()->filter(array(
                    'ClassName' => 'AcademicsPortalPage'
                ))->First();
                $group->LinkedPageID = $LinkedPage->ID;

                $group->Write();
            }     
        }
        
        $group->Members()->add($member);
        
        $form->addErrorMessage('Blurb', 'You have registered successfully. A representative will contact you shortly using the e-mail address provided.', 'Good');
        return $this->redirectBack();
    }
    
    public function createProfilePage() {
        $profile = new PartnersProfile();
        return $profile->write();
    }
    
    public function BasicInfoForm() {
        $member = Member::currentUser();
        if(!$member) { $this->httpError(403); return false; }
        
        $UploadField = new UploadField('BusinessLogo', 'Add your logo', File::get()->filter('ID', $member->BusinessLogoID)->First());
        $UploadField->setAllowedFileCategories('image');
        $UploadField->setAllowedMaxFileNumber(1);
        $UploadField->setFolderName('Logos');
        
        $fields = new FieldList(
            new TextField('BusinessName', 'Business Name<span>*</span>'),
            new TextField('BusinessWebsite', 'Website<span>*</span>'),
            $UploadField,
            new LiteralField('ContactInfo', '<h1>' . _t(
                'AcademicsRegisterForm.CONTACT',
                'Contact Info') . '</h1>'),
            new TextField('BusinessContact', 'Contact Name<span>*</span>'),
            new EmailField('Email', 'Contact Email<span>*</span>'),
            new TextField('BusinessTelephone', 'Contact Phone<span>*</span>'),
            new LiteralField('LiteralHeader', '<h1>' . _t(
                'AcademicsRegisterForm.DEFAULT',
                'Registration Info') . '</h1>'),
            new TextField('BusinessRegistrationNumber', 'Registration Number'),
            DropdownField::create('BusinessCountryID', _t(
            'MemberRegForm.COUNTRY',
            'Country of Registration'), array('selected' => $member->BusinessCountryID))->setEmptyString('Select a Country')->addExtraClass('country-select-dropdown'),
            ConfirmedPasswordField::create('Password', 'Password', "", null, true),
            new HiddenField('ID', 'ID')
        );
        
        $actions = FieldList::create(
            FormAction::create('saveBasicInfo', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save'))
        );
        
        $required = new RequiredFields(array(
            'BusinessType',
            'BusinessName',
            'ContactName',
            'ContactTelephone',
            'RegistrationNumber'
        ));
        
        return new Form($this->owner, 'BasicInfoForm', $fields, $actions, $required);
    }
    
    public function saveBasicInfo(array $data, Form $form) {
        if($data['ID'] != Member::currentUserID()) {
            $this->httpError(403);
        }
                
        $member = Member::currentUser();
        $form->saveInto($member);
        $member->FirstName = $data['BusinessName'];
        
        try {
			echo $member->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
            
			return $this->owner->redirectBack();
		}
        
        $form->addErrorMessage('Blurb', 'Your profile has been updated.', 'Good');
        return $this->redirectBack();
    }
    
    public function InstitutionProfileContentForm($id = 0) {        
        $fields = new FieldList(
            LiteralField::create(
            'InitTinyMCE', 
            '<script type="text/javascript">
            tinyMCE.init({
            theme : "advanced",
            mode: "textareas", 
            theme_advanced_toolbar_location : "top",
            theme_advanced_buttons1 : "bold,italic,underline,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,link,unlink,bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,fontsizeselect,formatselect,fontselect",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            height:"400px",
            width:"100%"
            });
            setTimeout(function () { 
                tinyMCE.activeEditor.onKeyPress.add(function(){$("textarea#"+tinyMCE.activeEditor.id).val(tinyMCE.activeEditor.getContent());});
                tinyMCE.activeEditor.onPaste.add(function(ed, e){$("textarea").val(tinyMCE.activeEditor.getContent());});
                }, 2000);
            </script>'),
            new LiteralField('HomePageContent', '<h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>Home Page Content</h1><div class="hidden-content">'),
            new TextField('WelcomeVideoLink', 'Link to welcome video. <strong>*Make sure to use embed link, not link to the actual video*</strong>'),
            $this->slideshowUploadField('One'),
            $this->slideshowUploadField('Two'),
            $this->slideshowUploadField('Three'),
            new LiteralField('EndHomePageContent', '</div>'),
            new LiteralField('AboutPageContent', '<h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>About Page Content</h1><div class="hidden-content">'),
            new HTMLEditorField('Vision', 'Vision'),
            new HTMLEditorField('MissionStatement', 'Mission Statement'),
            new HTMLEditorField('Values', 'Values'),
            new LiteralField('EndAboutPageContent', '</div>'),
            new LiteralField('ScholarshipPageContent', '<h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>Scholarship Page Content</h1><div class="hidden-content">'),

            new HTMLEditorField('Scholarships', 'Scholarship Information'),
            new LiteralField('EndScholarshipContent', '</div>'),
            new LiteralField('ContactPageContent', '<h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>Contact Page Content</h1><div class="hidden-content">'),

            new HTMLEditorField('ContactInfo', 'Contact Information'),
            new LiteralField('EndContactContent', '</div>'),
            new HiddenField('MemberID', 'MemberID', $id)
        );
        
        
        $actions = FieldList::create(
            FormAction::create('saveProfilePage', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save'))
        );
        
        $required = new RequiredFields(array(
            
        ));
        
        return new Form($this->owner, 'InstitutionProfileContentForm', $fields, $actions, $required);
    }
    
    public function AgentProfileContentForm($id = 0) {        
        $fields = new FieldList(
            LiteralField::create(
            'InitTinyMCE', 
            '<script type="text/javascript">
            tinyMCE.init({
            theme : "advanced",
            mode: "textareas", 
            theme_advanced_toolbar_location : "top",
            theme_advanced_buttons1 : "bold,italic,underline,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,link,unlink,bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,fontsizeselect,formatselect,fontselect",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            height:"400px",
            width:"100%"
            });
            setTimeout(function () { 
                tinyMCE.activeEditor.onKeyPress.add(function(){$("textarea#"+tinyMCE.activeEditor.id).val(tinyMCE.activeEditor.getContent());});
                tinyMCE.activeEditor.onPaste.add(function(ed, e){$("textarea").val(tinyMCE.activeEditor.getContent());});
                }, 2000);
            </script>'),
            new LiteralField('HomePageContent', '<h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>Home Page Content</h1><div class="hidden-content">'),
            new TextField('WelcomeVideoLink', 'Link to welcome video. <strong>*Make sure to use embed link, not link to the actual video*</strong>'),
            $this->slideshowUploadField('One'),
            $this->slideshowUploadField('Two'),
            $this->slideshowUploadField('Three'),
            new LiteralField('EndHomePageContent', '</div>'),
            new LiteralField('AboutPageContent', '<h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>About Page Content</h1><div class="hidden-content">'),
            new HTMLEditorField('Vision', 'Vision'),
            new HTMLEditorField('MissionStatement', 'Mission Statement'),
            new HTMLEditorField('Values', 'Values'),
            new LiteralField('EndAboutPageContent', '</div>'),
            new LiteralField('ContactPageContent', '<h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>Contact Page Content</h1><div class="hidden-content">'),

            new HTMLEditorField('ContactInfo', 'Contact Information'),
            new LiteralField('EndContactContent', '</div>'),
            new HiddenField('MemberID', 'MemberID', $id)
        );
        
        
        $actions = FieldList::create(
            FormAction::create('saveProfilePage', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save'))
        );
        
        $required = new RequiredFields(array(
            
        ));
        
        return new Form($this->owner, 'AgentProfileContentForm', $fields, $actions, $required);
    }
    
    public function saveProfilePage(array $data, Form $form) {
        $member = Member::currentUser();
        if(!$member || $data['MemberID'] != $member->ID) {
            $this->httpError(403);
        }
                
        $profilePage = PartnersProfile::get()->byID($member->PartnersProfileID);
        
        if(!$profilePage) {
            $profilePage = new ProfilePage();
            $member->PartnersProfileID = $profilePage->ID;
            try {
                $member->write();
            } catch(ValidationException $e) {
                $form->sessionMessage('There was an error saving your information. Please try again.', 'bad');

                return $this->owner->redirectBack();
            }
        }
        $form->saveInto($profilePage);

        try {
			$profilePage->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
            
			return $this->owner->redirectBack();
		}
        
        $form->addErrorMessage('Blurb', 'Your profile has been updated.', 'Good');
        return $this->redirectBack();
    }
        
    public function AddAcademicProgramsForm($member = null) {
        $member = Member::currentUser();
        
        $memberPrograms = $member->Programs();
        $FilterList = array();
        foreach($memberPrograms as $program)
            $FilterList[] = $program->ProgramNameID;

        $programs = ProgramName::get()->exclude('ID',$FilterList)->map('ID','Name');

        
        $fields = new FieldList(
            new LiteralField('AddProgram', '<h2>Add A New Program</h2>'),
            DropdownField::create(
                'ProgramNameID', 
                'Select the program you would like to add.',
                $programs)->setEmptyString('Select program to add.'),
            TextField::create('CertificateLink', 'Link to Program\'s Certification'),
            TextField::create('DiplomaLink', 'Link to Program\'s Diploma'),
            TextField::create('DegreeLink', 'Link to Program\'s Degree'),
            TextField::create('MastersLink', 'Link to Program\'s Masters'),
            TextField::create('DoctorateLink', 'Link to Program\'s Doctorate')
        );
        
        $actions = FieldList::create(
            FormAction::create('addAcademicProgram', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Add'))
        );
        
        $required = new RequiredFields(array(
            'ProgramName'
        ));
        
        return new Form($this->owner, 'AddAcademicProgramsForm', $fields, $actions, $required);
    }
    
    public function addAcademicProgram(array $data, Form $form) {
        if(!Member::currentUserID()) { return $this->httpError(403); }
        
        $program = new Program();
        $form->saveInto($program);
        $program->InstitutionID = Member::currentUserID();
        
        try {
			$program->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');   
			return $this->owner->redirectBack();
		}
                
        $form->addErrorMessage('Blurb', 'Your program has been added.', 'Good');
        return $this->redirectBack();
    }
    
    public function EditAcademicProgramsForm($member = null) {
        $member = Member::currentUser();
        
        if($member->Programs()) {
            $programs = $member->Programs()->map('ID', 'Title', 'Please Select');
        } else {
            $programs = array('empty', 'Add programs to edit.');
        }
            
        $fields = new FieldList(
            new LiteralField('EditPrograms', '<h2>Edit Your Programs</h2>'),
            DropdownField::create('ProgramID', 'Edit Your Programs', $programs)->setEmptyString('Select a program to edit.')->addExtraClass('edit-program-select'),
            TextField::create('CertificateLink', 'Link to Program\'s Certification')->addExtraClass('CertificateLink'),
            TextField::create('DiplomaLink', 'Link to Program\'s Diploma')->addExtraClass('DiplomaLink'),
            TextField::create('DegreeLink', 'Link to Program\'s Degree')->addExtraClass('DegreeLink'),
            TextField::create('MastersLink', 'Link to Program\'s Masters')->addExtraClass('MastersLink'),
            TextField::create('DoctorateLink', 'Link to Program\'s Doctorate')->addExtraClass('DoctorateLink')
        );
        
        $actions = FieldList::create(
            FormAction::create('editAcademicPrograms', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save')),
            FormAction::create('deleteAcademicProgram', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Delete'))
        );
        
        $required = new RequiredFields(array(
            'ProgramName'
        ));
        
        return new Form($this->owner, 'EditAcademicProgramsForm', $fields, $actions, $required);
    }
    
    public function editAcademicPrograms(array $data, Form $form) {
        if(!Member::currentUserID()) {return $this->httpError(403);}
        
        $program = Program::get()->byID($data['ProgramID']);
        
        if(!$program || $program->InstitutionID != Member::currentUserID()) {
            $form->addErrorMessage('Blurb', 'There was an error. Select a new program and try again.', 'Bad');
            return $this->redirectBack();
        }

        $form->saveInto($program);
            
        try {
			$program->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');   
			return $this->owner->redirectBack();
		}
                
        $form->addErrorMessage('Blurb', 'Your program has been updated.', 'Good');
        return $this->redirectBack();
    }
    
    public function deleteAcademicProgram(array $data, Form $form) {
        if(!Member::currentUserID()) {return $this->httpError(403);}
        
        $program = Program::get()->byID($data['ProgramID']);
        
        if(!$program || $program->InstitutionID != Member::currentUserID()) {
            $form->addErrorMessage('Blurb', 'There was an error. Select a new program and try again.', 'Bad');
            return $this->redirectBack();
        }
        
        $program->delete();
        if(Member::currentUser()->Programs()) {
            $form->addErrorMessage('Blurb', 'Your program has been deleted.', 'Good');
        }
        
        return $this->redirectBack();
    }
    
    public function AddAcademicServiceForm($member = null) {
        $member = Member::currentUser();
        
        $memberServices = $member->Services();
        $FilterList = array();
        foreach($memberServices as $service)
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
            FormAction::create('addAcademicService', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Add'))
        );
        
        $required = new RequiredFields(array(
            'ServiceNameID'
        ));
        
        return new Form($this->owner, 'AddAcademicServiceForm', $fields, $actions, $required);
    }
    
    public function addAcademicService(array $data, Form $form) {
        if(!Member::currentUserID()) { return $this->httpError(403); }
        
        $service = new Service();
        $form->saveInto($service);
        $service->AgentID = Member::currentUserID();
        
        try {
			$service->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');   
			return $this->owner->redirectBack();
		}
                
        $form->addErrorMessage('Blurb', 'Your service has been added.', 'Good');
        return $this->redirectBack();
    }
    
    public function EditAcademicServiceForm($member = null) {
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
            FormAction::create('editAcademicService', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save')),
            FormAction::create('deleteAcademicService', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Delete'))
        );
        
        $required = new RequiredFields(array(
            'ServiceName'
        ));
        
        return new Form($this->owner, 'EditAcademicServiceForm', $fields, $actions, $required);
    }
    
    public function editAcademicService(array $data, Form $form) {
        if(!Member::currentUserID()) {return $this->httpError(403);}
        
        $service = Service::get()->byID($data['ServiceID']);
        
        if(!$service || $service->AgentID != Member::currentUserID()) {
            $form->addErrorMessage('Blurb', 'That service was not found. Select a new service and try again.', 'Bad');
            return $this->redirectBack();
        }

        $form->saveInto($service);
            
        try {
			$service->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');   
			return $this->owner->redirectBack();
		}
                
        $form->addErrorMessage('Blurb', 'Your service has been updated.', 'Good');
        return $this->redirectBack();
    }
    
    public function deleteAcademicService(array $data, Form $form) {
        if(!Member::currentUserID()) {return $this->httpError(403);}
        var_dump($data);
        $service = Service::get()->byID($data['ServiceID']);
        
        if(!$service || $service->AgentID != Member::currentUserID()) {
            $form->addErrorMessage('Blurb', 'There was an error. Select a new service and try again.', 'Bad');
            return $this->redirectBack();
        }
        
        $service->delete();
        if(Member::currentUser()->Services()) {
            $form->addErrorMessage('Blurb', 'Your service has been deleted.', 'Good');
        }
        
        return $this->redirectBack();
    }
    
    public function ProfileLinksForm($id = 0) {
        $fields = new FieldList(
            new LiteralField('Description', 'Provide links to the following documents.'),
            new TextField('AdmissionRequirements', 'Admission Requirements'),
            new TextField('EnglishRequirements', 'English Requirements'),
            new TextField('ProcessingTime', 'Processing Time'),
            new TextField('Fees', 'Fees'),
            new TextField('Application', 'Application'),
            new HiddenField('MemberID', 'MemberID', $id)
        );
        
        $actions = FieldList::create(
            FormAction::create('saveProfilePage', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save'))
        );
        
        $required = new RequiredFields(array(
            'Application'
        ));
        
        return new Form($this->owner, 'ProfileLinksForm', $fields, $actions, $required);
    }
    
    private function slideshowUploadField($slideNumber) {
        $UploadField = new UploadField('Slide'.$slideNumber, 'Slide '.$slideNumber);
        $UploadField->setAllowedFileCategories('image');
        $UploadField->setAllowedMaxFileNumber(1);
        $UploadField->setCanPreviewFolder(false);
        $UploadField->upload->setReplaceFile(true);
        $UploadField->setOverwriteWarning(true);
        $UploadField->setFolderName('slideshow_photos/'.Member::currentUserID());
        return $UploadField;
    }
    
    public function getProfileLink() {
        $member = Member::currentUser();

        if(!$member) {
            return false;
        }

        if($member->isUniversity()) {
            $portalPage = PartnersPortalPage::get()->First();
            return $portalPage->Link() . 'edit/university/' . $member->ID;
        } else if($member->isAgent()) {
            $portalPage = PartnersPortalPage::get()->First();
            return $portalPage->Link() . $portalPage . 'edit/agent/' . $member->ID;
        } else if($member->isStudent()) {
            return $profilePage = MemberProfilePage::get()->filter(array(
            'AllowRegistration' => '0',
            'AllowProfileEditing' => '1'
        ))->First()->Link();
            
        }
    }
    
    public function AgentPartnersForm($id = 0) {
        $member = Member::currentUser();
        if(!$member) { return Security::permissionFailure(); }
        
        $items = Member::get()->filter('MemberType', 'Agent')->map('ID', 'BusinessName', '--Select agencies--')->toArray();
        $current = array();
        foreach($member->Agents() as $agent) {
            $current[] = $agent->ID;
        }
        
        $fields = new FieldList(
            new LiteralField('AgentPartners', 'Select the agents you would like to partner with.'),
            ListboxField::create('Agents', 'Agents')->setMultiple(true)->setSource($items)->setValue($current),
            new HiddenField('MemberID', 'MemberID', $id)
        );
        
        $actions = FieldList::create(
            FormAction::create('saveAgentPartners', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save'))
        );
        
        $required = new RequiredFields(array(
            'Agents'
        ));
        
        return new Form($this->owner, 'AgentPartnersForm', $fields, $actions, $required);
    }
    
    public function saveAgentPartners(array $data, Form $form) {
        $member = Member::currentUser();
        if(!$member) { return Security::permissionFailure(); }
        
        $current = array();
        foreach($member->Agents() as $agent) {
            $current[] = $agent->ID;
        }
        
        $toAdd = array_diff($data['Agents'], $current);
        $toRemove = array_diff($current, $data['Agents']);
        
        $addedString = '';
        $removedString = '';
        
        foreach($toAdd as $add) {
            $agent = Member::get()->byID($add);
            if(!$agent || !$agent->isAgent()) { echo "false"; continue; }
            
            $member->Agents()->add($agent);
            $addedString .= $agent->BusinessName;
        }
        foreach($toRemove as $remove) {
            $agent = Member::get()->byID($remove);
            if(!$agent || !$agent->isAgent()) { echo "false"; }
            
            $member->Agents()->remove($agent);  
            $removedString .= $agent->BusinessName . ' ';            
        }
        
        $returnString = '';

        if($removedString) { $returnString .= 'You removed: '. $removedString; } 
        if($addedString) { $returnString .= ' / You added: '. $addedString; } 
        $form->addErrorMessage('Blurb', $returnString, 'Good');

        $this->redirectBack();
    }
    
    public function SchoolPartnersForm($id = 0) {
        $member = Member::currentUser();
        if(!$member) { return Security::permissionFailure(); }
        
        $items = Member::get()->filter('MemberType', 'University')->map('ID', 'BusinessName', '--Select schools--')->toArray();
        $current = array();
        foreach($member->Schools() as $schools) {
            $current[] = $schools->ID;
        }
        
        $fields = new FieldList(
            new LiteralField('School Partners', 'Select the schools you would like to partner with.'),
            ListboxField::create('Schools', 'Schools')->setMultiple(true)->setSource($items)->setValue($current),
            new HiddenField('MemberID', 'MemberID', $id)
        );
        
        $actions = FieldList::create(
            FormAction::create('saveSchoolPartners', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save'))
        );
        
        $required = new RequiredFields(array(
            'Schools'
        ));
        
        return new Form($this->owner, 'SchoolPartnersForm', $fields, $actions, $required);
    }
    
    public function saveSchoolPartners(array $data, Form $form) {
        $member = Member::currentUser();
        if(!$member) { return Security::permissionFailure(); }
        
        $current = array();
        foreach($member->Schools() as $school) {
            $current[] = $school->ID;
        }
        
        $toAdd = array_diff($data['Schools'], $current);
        $toRemove = array_diff($current, $data['Schools']);
        
        $addedString = '';
        $removedString = '';
        
        foreach($toAdd as $add) {
            $school = Member::get()->byID($add);
            if(!$school || !$school->isUniversity()) { echo "false"; continue; }
            
            $member->Schools()->add($school);
            if($member->MemberType == "Agent") {
                $school->Agents()->add($member);
            }
            $addedString .= $school->BusinessName;
        }
        foreach($toRemove as $remove) {
            $school = Member::get()->byID($remove);
            if(!$school || !$school->isUniversity()) { echo "false"; }
            
            $member->Schools()->remove($school);
            if($member->MemberType == "Agent") {
                $school->Agents()->add($member);
            }
            $removedString .= $school->BusinessName . ' ';            
        }
        
        $returnString = '';

        if($removedString) { $returnString .= 'You removed: '. $removedString; } 
        if($addedString) { $returnString .= ' / You added: '. $addedString; } 
        $form->addErrorMessage('Blurb', $returnString, 'Good');

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
        } else if($program->InstitutionID != Member::currentUserID()) {
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
                'error'=>'Program not found',
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