<?php 
 
class PartnersPortalPage extends Page 
{
     private static $db = array(
         'Message' => 'Text',
     );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
              
        $fields->addFieldToTab("Root.Main", new TextareaField('Message', 'Message'), 'Content');      
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
        'ProfileContentForm',
        'saveProfilePage'
    );
    
    private static $url_handlers = array(
        'university/$MemberID' => 'edit',
        'agent/$MemberID' => 'edit'
    );
    
    public function edit() {
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
        $member = new Member();
        
		$form->saveInto($member);
        $member->FirstName = $data['BusinessName'];
        
        $member->PartnersProfileID = $this->createProfilePage();
        
        try {
			$member->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return;
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
        } else {
            $form->addErrorMessage('BusinessType', 'Pick a type!', 'Bad');
            return $this->redirectBack();
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
        if(!$member) { return false; }
        $fields = new FieldList(
            new TextField('BusinessName', 'Business Name<span>*</span>'),
            new TextField('BusinessWebsite', 'Website<span>*</span>'),
            new LiteralField('LiteralHeader', '<h1>' . _t(
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
    
    public function ProfileContentForm($id = 0) {
        $fields = new FieldList(
            new TextAreaField('MissionStatement', 'Mission Statement'),
            new TextAreaField('Values', 'Values'),
            new TextAreaField('Vision', 'Vision'),
            new HiddenField('MemberID', 'MemberID', $id)
        );
        
        $imageUpload = new FileField('LogoImage', 'Business Logo (use a .png or .jpg file)');
        $imageUpload->getValidator()->allowedExtensions = array('jpg', 'png');
        $imageUpload = $imageUpload->setFolderName($imageUpload->getFolderName . '/Logos');

        $fields->insertBefore($imageUpload, 'MissionStatement');
        
        $actions = FieldList::create(
            FormAction::create('saveProfilePage', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save'))
        );
        
        $required = new RequiredFields(array(
            'MissionStatement',
            'Values',
            'Vision'
        ));
        
        return new Form($this->owner, 'ProfileContentForm', $fields, $actions, $required);
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
    
    public function saveProfilePage(array $data, Form $form) {
        $member = Member::currentUser();
        if(!$member || $data['MemberID'] != $member->ID) {
            $this->httpError(403);
        }
        
                
        $profilePage = PartnersProfile::get()->byID($member->PartnersProfileID);
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
    
    public function getProfileLink() {
        $member = Member::currentUser();

        if(!$member) {
            return false;
        }

        if($member->isUniversity()) {
            $portalPage = PartnersPortalPage::get()->First()->Link();
            return $portalPage->Link() . 'edit/university/' . $member->ID;
        } else if($member->isAgent()) {
            $portalPage = PartnersPortalPage::get()->First()->Link();
            return $portalPage->Link() . $portalPage . 'edit/agent/' . $member->ID;
        } else if($member->isStudent()) {
            return $profilePage = MemberProfilePage::get()->filter(array(
            'AllowRegistration' => '0',
            'AllowProfileEditing' => '1'
        ))->First()->Link();
            
        }
    }   
    
}