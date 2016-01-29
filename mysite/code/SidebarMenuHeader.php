<?php

class SidebarMenuHeader extends Page 
{
    private static $defaults = array(
        'menuWelcome' => false,
        'menuStudent' => false,
        'menuUniversity' => false,
        'menuStudentSidebar' => true,
        'showDropdown' => true
    );
    
    private static $allowed_children = array(
        'SidebarMenuPage'
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab("Root.Main", new HtmlEditorField('Content', 'Content'));
        
        return $fields;
    }
}
 
class SidebarMenuHeader_Controller extends Page_Controller 
{
     private static $allowed_actions = array(
        'saveProfileForm',
        'BasicProfileForm',
        'AddressProfileForm',
        'EducationProfileForm',
        'ContactProfileForm',
        'EmergencyContactProfileForm',
        'ProfilePictureForm'
    );
    
    public function init() {

        parent::init();
        
        if(Permission::check('EDIT_STUDENT')) {
            Security::permissionFailure(null, 'You need to be logged into a student profile to view this content.');
        }
    }
    
    public function Member() { return Member::currentUser(); }
    
    public function ChatLink($member = null) {
        if(!$member) {
            $member = Member::currentUser(); 
        }
        
        $chatName = preg_replace("/[^A-Za-z0-9]/", "", $member->FirstName) . '%20' . preg_replace("/[^A-Za-z0-9]/", "", $member->Surname);
        $userurl = Director::absoluteURL("myprofile/show/".$member->ID, true);
        
        return "http://localhost/ajax/chat?userName=" . $chatName . "&userID=".$member->ID;
    }
    
    public function BlogManagementURLs($member = null) {
        if(!$member) $member = Member::currentUser();
        
        //if not a student, member has no blog to manage
        if(!Permission::check('BLOG_MANAGEMENT')) {
            return "You do not have a blog to manage.";
        }
        
        //get blog holder for member
        $holder = BlogHolder::get()->filter(array(
            'ownerID' => $member->ID
        ))->First();
        
        if(!$holder) {
            $blogTree = SiteTree::get()->filter(array(
                'ClassName' => 'BlogTree',
                'Title' => 'Student Blogs'
            ))->First();
            $blogID = $this->createNewStudentBlog($member, $blogTree);
            $holder = BlogHolder::get()->ByID($blogID);
        }
        
        $urls = "<li><a title='Create a new blog post' href='". $holder->Link() . "post'>" . _t('StudentProfile.NEWBLOGPOST', 'New Blog Post') . "</a></li>";
        $urls .= "<li><a title='View main blog page' href='". $holder->Link() . "'>" . _t('StudentProfile.VIEWBLOG', 'View Your Blog Posts') . "</a></li>";
        $urls .= "<li><a title='View main blog page' href='". $holder->parent()->Link() . "'>" . _t('StudentProfile.VIEWBLOG', 'View All Blog Posts') . "</a></li>";
        
        return $urls;
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
}