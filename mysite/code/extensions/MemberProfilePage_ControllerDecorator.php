<?php

//Adds hooks to: 
//  Profile page form
//  Register form
//  Member add
class MemberProfilePage_ControllerDecorator extends DataExtension {

    //student registration form
    public function updateRegisterForm($form) 
    {
        $fields = $form->Fields();
		
        $fields->insertBefore(new LiteralField('Hd_Personal', '<h3>Personal Info<h3>'), 'FirstName');
        $fields->insertAfter(new TextField('Username', 'Username'), 'Hd_Personal');
        $fields->insertAfter(new TextField('MiddleName', 'Middle Name'), 'Firstname');
        $fields->insertAfter(new CountryDropdownField('Nationality', 'Nationality'), 'Email');
		
        $fields->insertAfter(new LiteralField('Hd_Address', '<h3>Address<h3>'), 'Nationality');
        $fields->insertAfter(new TextField('StreetAddress', 'Street Address'), 'Hd_Address');
        $fields->insertAfter(new DropdownField('City', 'City', HighSchool::getHighSchoolOptions()), 'StreetAddress');
        $fields->insertAfter(new CountryDropdownField('Country', 'Current Country'), 'City');
        $fields->insertAfter(new TextField('PostalCode', 'Postal Code'), 'Country');
        $fields->insertAfter(new DropdownField('HighSchool', 'High School', HighSchool::getHighSchoolOptions()), 'StreetAddress');
        
        $fields->insertBefore(new LiteralField('Hd_Security', '<h3>Security<h3>'), 'Password');        
        
        $form->setFields($fields);
    }
    
    //---Profile Page Data---//
    
    //add extra data to profile page
    public function updateProfilePageData(&$pageData)
    {
        unset($pageData['Form']);
        
        $member = Member::currentUser();
        $pageData['Member'] = $member;
        
        $basicForm = $this->BasicProfileForm();
        $basicForm->loadDataFrom($member);

        $educationForm = $this->EducationProfileForm($member);
        $educationForm->loadDataFrom($member);

        $addressForm = $this->AddressProfileForm($member);
        $addressForm->loadDataFrom($member);

        $pageData['BasicProfileForm'] = $basicForm;
        $pageDate['EducationProfileForm'] = $educationForm;
        $pageDate['AddressProfileForm'] = $addressForm;

        $holder = BlogHolder::get()->filter(array(
            'ownerID' => $member->ID
        ))->First();
        
        if(!$holder) {
            $pageData['BlogHolder'] = false;
            return $pageData;
        }
        
        $pageData['BlogPostURL'] = $holder->postURL();
        
        $entries = BlogEntry::get()->filter(array(
            'ParentID' => $holder->ID
        ))->limit(10);
        
        $pageData['BlogEntries'] = $entries;
        
        return $pageData;
    }
    
    
    //form for basic info on profile
    public function BasicProfileForm()
    {
        $fields = new FieldList(
            new TextField('FirstName', 'First Name'),
            new TextField('MiddleName', 'Middle Name'),
            new TextField('Surname', 'Family Name'),
            new DateField('DateOfBirth', 'Birthday'),
            new CountryDropdownField('Nationality', 'Nationality'),
            new EmailField('Email', 'Email')
        );
        
        $actions = new FieldList(
            new FormAction('save', 'Save')
        );
        
        $required = new RequiredFields(array());
        
        return new Form($this->owner, 'ProfileForm', $fields, $actions, $required);
    }
    
    //form for address input
    public function AddressProfileForm($member = null)
    {
        if(!$member) {
            $memberEmail = Member::currentUser()->Email;
            $userName = Member::currentUser()->Username;
        } else {
            $memberEmail = $member->Email;
            $userName = $member->Username;
        }
        
        $fields = new FieldList(
            new TextField('StreetAddress', 'Street Address'),
            new DropdownField('City', 'City', City::getCityOptions()),
            new CountryDropdownField('Country', 'Current Country'),
            new TextField('PostalCode', 'Postal Code'),
            new HiddenField('Username', 'Username', $userName),
            new HiddenField('Email', 'Email', $memberEmail)
        );
        
        $actions = new FieldList(
            new FormAction('save', 'Save')
        );
        
        $required = new RequiredFields(array());
        
        return new Form($this->owner, 'ProfileForm', $fields, $actions, $required);
    }
    
    //education info form
    public function EducationProfileForm($member = null)
    {
        if(!$member) {
            $memberEmail = Member::currentUser()->Email;
            $userName = Member::currentUser()->Username;
        } else {
            $memberEmail = $member->Email;
            $userName = $member->Username;
        }
        
        $fields = new FieldList(
            new DropdownField('HighSchool', 'High School', HighSchool::getHighSchoolOptions()),
            new DateField('HSGraduation', 'High School Graduation Date'),
            new DropdownField('University', 'University', University::getUniversityOptions()),
            new DateField('UniversityGraduation', 'University Graduation Date'),
            new HiddenField('Username', 'Username', $userName),
            new HiddenField('Email', 'Email', $memberEmail)
        );
        
        $actions = new FieldList(
            new FormAction('save', 'Save')
        );
        
        $required = new RequiredFields(array());

        return new Form($this->owner, 'ProfileForm', $fields, $actions, $required);
    }
    
    //---End Profile Page Data---//
    
    
    
    //ToDo after member added
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
        $blogHolder->Title = $member->FirstName . " " . $member->Surname;
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