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
    
    public function ProfileContentForm($id = 0) {        
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
            new LiteralField('HomePageContent', '<h1>Home Page Content</h1>'),
            new TextField('WelcomeVideoLink', 'Link to welcome video. <strong>*Make sure to use embed link, not link to the actual video*</strong>'),
            $this->slideshowUploadField('One'),
            $this->slideshowUploadField('Two'),
            $this->slideshowUploadField('Three'),
            new LiteralField('AboutPageContent', '<h1>About Page Content</h1>'),
            new HTMLEditorField('Vision', 'Vision'),
            new HTMLEditorField('MissionStatement', 'Mission Statement'),
            new HTMLEditorField('Values', 'Values'),
            new LiteralField('ScholarshipsPageContent', '<h1>Scholarships Page Content</h1>'),
            new HTMLEditorField('Scholarships', 'Scholarships Content'),
                        new LiteralField('ContactPageContent', '<h1>Contact Page Content</h1>'),

            new HTMLEditorField('ContactInfo', 'Contact Information'),
            new HiddenField('MemberID', 'MemberID', $id)
        );
        
        $actions = FieldList::create(
            FormAction::create('saveProfilePage', _t(
                'AcademicsRegisterForm.DEFAULT',
                'Save'))
        );
        
        $required = new RequiredFields(array(
            
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
    
}