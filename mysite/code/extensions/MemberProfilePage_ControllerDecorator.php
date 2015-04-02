<?php

//Adds hooks to: 
//  Profile page form
//  Register form
//  Member add
class MemberProfilePage_ControllerDecorator extends DataExtension {
    
    private static $allowed_actions = array(
        'saveProfileForm',
        'saveProfilePicture',
        'BasicProfileForm',
        'AddressProfileForm',
        'EducationProfileForm',
        'ContactProfileForm',
        'EmergencyContactProfileForm',
        'ProfilePictureForm'
        
    );

    //student registration form
    public function updateRegisterForm($form) 
    {
        $fields = $form->Fields();
		
        $fields->insertBefore(new LiteralField('Hd_Personal', '<h3>Personal Info</h3>'), 'FirstName');
        $fields->insertAfter(new TextField('Username', 'Username'), 'Hd_Personal');
        $fields->insertAfter(new TextField('MiddleName', 'Middle Name'), 'Firstname');
        $fields->insertAfter(new CountryDropdownField('Nationality', 'Nationality'), 'Email');
		
        $fields->insertAfter(new LiteralField('Hd_Address', '<h3>Address</h3>'), 'Nationality');
        $fields->insertAfter(new TextField('StreetAddress', 'Street Address'), 'Hd_Address');
        $fields->insertAfter(new DropdownField('City', 'City', HighSchool::getHighSchoolOptions()), 'StreetAddress');
        $fields->insertAfter(new CountryDropdownField('Country', 'Current Country'), 'City');
        $fields->insertAfter(new TextField('PostalCode', 'Postal Code'), 'Country');
        $fields->insertAfter(new DropdownField('HighSchool', 'High School', HighSchool::getHighSchoolOptions()), 'StreetAddress');
        
        $fields->insertBefore(new LiteralField('Hd_Security', '<h3>Security</h3>'), 'Password');        
        
        $form->setFields($fields);
    }
    
    //---Profile Page Data---//
    
    //add extra data to profile page
    public function updateProfilePageData(&$pageData)
    {
        unset($pageData['Form']);
        
        $member = Member::currentUser();
        $pageData['Member'] = $member;
        
    //pass link to student chatroom with username as 'firstName lastName'
        $chatName = $member->FirstName . "%20" . $member->Surname;
        $pageData['chatLink'] = "/chat/chat.php?username=" . $chatName;
        
        //get all form data
        $basicForm = $this->BasicProfileForm($member);
        $basicForm->loadDataFrom($member);

        $educationForm = $this->EducationProfileForm($member);
        $educationForm->loadDataFrom($member);

        $addressForm = $this->AddressProfileForm($member);
        $addressForm->loadDataFrom($member);
        
        $emergencyForm = $this->EmergencyContactProfileForm($member);
        $emergencyForm->loadDataFrom($member);
        
        $pictureForm = $this->ProfilePictureForm($member);
        $pictureForm->loadDataFrom($member);

        $pageData['BasicProfileForm'] = $basicForm;
        $pageData['EducationProfileForm'] = $educationForm;
        $pageData['AddressProfileForm'] = $addressForm;
        $pageData['EmergencyContactProfileForm'] = $emergencyForm;
        $pageData['ImageUpload'] = $this->ProfilePictureForm($member);
        $pageData['IsSelf'] = $member->ID == Member::currentUserID();

        // get profile picture
        $profilePicture = File::get()->filter(array(
            'ClassName' => 'Image',
            'ID'        => $member->ProfilePictureID
        ))->First();
        if(!$profilePicture) {
            $pageData['ProfilePictureFile'] = "assets/Uploads/Desert.jpg";
        } else {
            $pageData['ProfilePictureFile'] = $profilePicture->Filename;
        }
            
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
        
        return $pageData;
    }
    
    // get profile picture
    public function ProfilePicture($member = null)
    {
        if(!$member) {
            $member = Member::currentUser();
        }
        
        $profilePicture = File::get()->filter(array(
            'ClassName' => 'Image',
            'ID'        => $member->ProfilePictureID
        ))->First();
        if(!$profilePicture) {
            $pageData['ProfilePictureFile'] = "assets/Uploads/default:wq.jpg";
        } else {
            $pageData['ProfilePictureFile'] = $profilePicture->Filename;
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
    public function BasicProfileForm($member = null)
    {
        if(!$member) {
            $member = Member::currentUser();
        }
        
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>Contact Info</h2>'),
            new TextField('FirstName', 'First Name<span>*</span>'),
            new TextField('MiddleName', 'Middle Name'),
            new TextField('Surname', 'Family Name<span>*</span>'),
            new DateField('DateOfBirth', 'Birthday'),
            new CountryDropdownField('Nationality', 'Nationality'),
            new EmailField('Email', 'Email<span>*</span>')
        );
        
        $actions = new FieldList(
            new FormAction('saveProfileForm', 'Save')
        );
        
        $required = new RequiredFields(array(
            'FirstName',
            'Surname',
            'Email'
        ));
        
        return new Form($this->owner, 'BasicProfileForm', $fields, $actions, $required);
    }
    
    //form for address input
    public function AddressProfileForm($member = null)
    {
        if(!$member) {
            $member = Member::currentUser();
        }   
        
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>Current Address</h2>'),
            new TextField('StreetAddress', 'Street Address<span>*</span>'),
            new DropdownField('City', 'City', City::getCityOptions()),
            new CountryDropdownField('Country', 'Current Country<span>*</span>'),
            new TextField('PostalCode', 'Postal Code'),
            
            new HiddenField('Username', 'Username'),
            new HiddenField('Email', 'Email')
        );
        
        $actions = new FieldList(
            new FormAction('saveProfileForm', 'Save')
        );
        
        $required = new RequiredFields(array(
            'StreetAddress',
            'Country'
        ));
        
        return new Form($this->owner, 'AddressProfileForm', $fields, $actions, $required);
    }

    //education info form
    public function EducationProfileForm($member = null)
    {
        if(!$member) {
            $member = Member::currentUser();
        }
               
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>Education Information</h2>'),
            new DropdownField('HighSchoolID', 'High School<span>*</span>', HighSchool::getHighSchoolOptions()),
            new DateField('HSGraduation', 'High School Graduation Date'),
            new DropdownField('UniversityID', 'University<span>*</span>', University::getUniversityOptions()),
            new DateField('UniversityGraduation', 'University Graduation Date'),
            
            new HiddenField('Username', 'Username'),
            new HiddenField('Email', 'Email')
        );
        
        $actions = new FieldList(
            new FormAction('saveProfileForm', 'Save')
        );
        
        $required = new RequiredFields(array(
            'HighSchoolID',
        ));

        return new Form($this->owner, 'EducationProfileForm', $fields, $actions, $required);
    }
     
    public function EmergencyContactProfileForm($member = null)
    {
        if(!$member) {
            $member = Member::currentUser();
        }
        
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>Emergency Contact Details</h2>'),
            new TextField('ContactFirstName', 'First Name<span>*</span>'),
            new TextField('ContactSurname', 'Last Name<span>*</span>'),
            new PhoneNumberField('ContactTelephone', 'Telephone'),
            new CountryDropdownField('ContactCountry', 'Current Country'),
            new EmailField('ContactEmail', 'Email<span>*</span>'),

            new HiddenField('Username', 'Username'),
            new HiddenField('Email', 'Email')
        );
        
        $actions = new FieldList(
            new FormAction('saveProfileForm', 'Save')
        );
        
        $required = new RequiredFields(array(
            'ContactFirstName',
            'ContactSurname',
            'ContactEmail'
        ));

        return new Form($this->owner, 'EmergencyContactProfileForm', $fields, $actions, $required);
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
    
    public function ProfilePictureForm($member = null) {
        if(!$member) {
            $member = Member::currentUser();
        }
        
        $fields = new FieldList(
            new LiteralField('Hd_ProfilePicture', '<h3>Upload A New Profile Picture</h3>'),
            new HiddenField('Username', 'Username'),
            new HiddenField('Email', 'Email')
        );

        $imageUpload = new FileField('ProfilePicture', 'Use a .jpg or .png image file');
        $imageUpload->getValidator()->allowedExtensions = array('jpg', 'png');
//        $imageUpload->setAllowedMaxFileNumber(1);
//        $imageUpload->setCanPreviewFolder(false);
//        $imageUpload->setCanAttachExisting(false);
//        
        $fields->insertBefore($imageUpload, 'Username');
        
        $actions = new FieldList(
            new FormAction('saveProfilePicture', 'Upload')
        );
        
        $required = new RequiredFields(array(
            'ProfilePicture'
        ));

        return new Form($this->owner, 'ProfilePictureForm', $fields, $actions, $required);
    }   
    
    public function saveProfilePicture(array $data, Form $form) {
        var_dump($data);
        
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
        
        return $this->owner->redirectBack();

    }
    
    //---End Profile Page Data---//
    
    
    //Done after member added
    //1. Create Blog Page
    //2. Add member to appropriate groups
    public function onAddMember($member)
    {
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
        $blogHolder = new BlogHolder();
        $blogHolder->Title = $member->ID;
        $blogHolder->AllowCustomAuthors = true;
        $blogHolder->OwnerID = $member->ID;
        $blogHolder->URLSegment = $member->FirstName."-".$member->Surname;
        $blogHolder->Status = "Published";
        $blogHolder->ParentID = $blogTree->ID;
        
        $widgetArea = new WidgetArea();
        $widgetArea->write();
        
        $blogHolder->SideBarWidgetID = $widgetArea->ID;
        $blogHolder->write();
        $blogHolder->doRestoreToStage();
        
        $managementWidget = new BlogManagementWidget();
        $managementWidget->ParentID = $widgetArea->ID;
        $managementWidget->Enabled = 1;
        $managementWidget->write();
        
        //create welcome blog entry
        $blog = new BlogEntry();
        $blog->Title = "Welcome to the ISNetwoork".$member.FirstName."!";
        $blog->Author = "Admin";
        $blog->URLSegment = 'first-post';
        $blog->Tags = "created, first, welcome";
        $blog->Content = "<p>Thank you for registering with the ISNetwork. Take a look around.</p>";
        $blog->Status = "Published";
        $blog->ParentID = $blogHolder->ID;
        $blog->write();
        $blog->doRestoreToStage();
        
        //---- 2. add member to groups: student, user
        if(!$userGroup = DataObject::get_one('Group', "Code = 'users'"))
        {
            $userGroup = new Group();
            $userGroup->Code = "user";
            $userGroup->Title = "Users";
            $userGroup->Description = "All registered users";
            $LinkedPage = SiteTree::get()->filter(array(
                'ClassName' => 'MemberProfilePage',
                'Title' => 'MyProfile'))->First();
            $userGroup->LinkedPageID = $LinkedPage->ID;
            
            $userGroup->Write();
        }
        //Add member to user group
        $userGroup->Members()->add($member);
    }
    
}