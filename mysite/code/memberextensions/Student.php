<?php
/**
 *
 * School class extends Member for students
 *
 */

class Student extends Member {
    
    private static $db = array(
        'MiddleName' => 'Varchar(100)',
        'Telephone' => 'Varchar(30)',
        'PostalCode' => 'Varchar(100)',
        'AddressLineOne' => 'Varchar(100)',
        'AddressLineTwo' => 'Varchar(100)',
        'ContactName' => 'Varchar(100)',
        'ContactTelephone' => 'Varchar(100)',
        'ContactEmail' => 'Varchar(100)',
        'Birthdate' => 'Date',
        'City' => 'Varchar(100)',
        'HighSchool' => 'Varchar(100)',
        'HighSchoolGraduation' => 'Date',
        'University' => 'Varchar(100)',
        'UniversityGraduation' => 'Date'
    );
    
    private static $has_one = array(
        'ProfilePicture' => 'Image',
        'Nationality' => 'Country',
        'CurrentCountry' => 'Country',
        'ContactCountry' => 'Country'
    );
    
    private static $has_many = array(
        'SchoolApplications' => 'SchoolApplication',
        'MessageThreads' => 'MessageThread'
    );
    
    private static $summary_fields = array(
        'FirstName' => 'First Name',
        'Surname' => 'Last Name',
        'Email' => 'Email',
        'CurrentCountry.Name' => 'Country'
    );
    
    private static $searchable_fields = array(
        'FirstName' => 'PartialMatchFilter',
        'Surname' => 'PartialMatchFilter',
        'Email' => 'PartialMatchFilter',
        'CurrentCountry.Name' => 'PartialMatchFilter'
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $this->removeExtraFields($fields);
        //Profile
        $fields->addFieldToTab('Root.Profile', new TextField('FirstName', 'First Name'));
        $fields->addFieldToTab('Root.Profile', new TextField('MiddleName', 'Middle Name'));
        $fields->addFieldToTab('Root.Profile', new TextField('Surname', 'Surname'));

        $fields->addFieldToTab('Root.Profile', new DateField('Birthdate', 'Date of Birth'));      
        $fields->addFieldToTab('Root.Profile', DropdownField::create('NationalityID', 'Nationality', Country::getCountryOptions())->setEmptyString('Select a country'));
        $fields->addFieldToTab('Root.Contact', new TextField('Telephone', 'Telephone Number'));         
        $fields->addFieldToTab('Root.Contact', new TextField('AddressLineOne', 'Address Line One'));         
        $fields->addFieldToTab('Root.Contact', new TextField('AddressLineTwo', 'Address Line Two'));         
        $fields->addFieldToTab('Root.Contact', new DropdownField('CityID', 'City', City::getCityOptions()));         
        $fields->addFieldToTab('Root.Contact', DropdownField::create('CurrentCountryID', 'Current Country', Country::getCountryOptions())->setEmptyString('Select a country'));
        $fields->addFieldToTab('Root.Contact', new TextField('ContactName', 'Contact Name'));
        $fields->addFieldToTab('Root.Contact', new TextField('ContactTelephone', 'Contact Telephone'));
        $fields->addFieldToTab('Root.Contact', new EmailField('ContactEmail', 'Contact Email'));
        return $fields;
    }
    
    /* 
     * Remove unused fields from member form in CMS
     */
    private function removeExtraFields(FieldList $fields) {
        $fields->removeByName('FirstName');
        $fields->removeByName('Surname');
        $fields->removeByName('Country');
        $fields->removeByName('City');
        $fields->removeByName('FirstNamePublic');
        $fields->removeByName('SurnamePublic');
        $fields->removeByName('OccupationPublic');
        $fields->removeByName('CompanyPublic');
        $fields->removeByName('CityPublic');
        $fields->removeByName('CountryPublic');
        $fields->removeByName('EmailPublic');
        $fields->removeByName('Occupation');
        $fields->removeByName('Company');
        $fields->removeByName('Nickname');
        $fields->removeByName('Signature');
        $fields->removeByName('PostalCode');
    }
    
    public function viewLink() {
        return StudentPortalPage::get()->First()->Link('show/' . $this->ID);
    }
    
    public function editLink() {
        return StudentPortalPage::get()->First()->Link('edit');
    }
    
    public static function getStudentOptions() {
        if($students = DataObject::get("Student")->sort('Surname', 'ASC'))
        {
            return $students->map('ID', 'Name', 'Please Select');
        } else {
            return array('No Countries');
        }
    }
    
    public function DoneApplications() {
        return $this->SchoolApplications()->filter('Status', 'Completed');
    }
    
    public function InProcessApplications() {
        return $this->SchoolApplications()->exclude('Status', 'Completed');
    }
    
    public function getBlogHolder() {
        return BlogHolder::get()->filter('OwnerID', $this->ID)->First();
    }
    
    public function getLatestForumPosts($max = null) {
        if($max) {
            $posts = Post::get()->filter(array(
                'AuthorID' => $this->ID
            ))->sort('Created', 'DESC')->limit($max);
        } else {
            $posts = Post::get()->filter(array(
                'AuthorID' => $this->ID
            ))->sort('Created', 'DESC');
        }
        
        return $posts;
    }
    
    public function createNewStudentBlog(BlogTree $blogTree) {
        $blogHolder = new BlogHolder();
        $blogHolder->Title = $this->Name." ".$this->ID."'s Blog";
        $blogHolder->AllowCustomAuthors = false;
        $blogHolder->OwnerID = $this->ID;
        $blogHolder->URLSegment = $this->FirstName."-".$this->Surname."-".$this->ID;
        $blogHolder->Status = "Published";
        $blogHolder->ParentID = $blogTree->ID;
        
        $widgetArea = new WidgetArea();
        $widgetArea->write();
        
        $blogHolder->SideBarWidgetID = $widgetArea->ID;
        $this->BlogHolder = $blogHolder->write();
        $this->write();
        
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
        $blog->Title = "Welcome to GenXYZ, " . $this->FirstName . "!";
        $blog->Author = "Admin";
        $blog->URLSegment = 'first-post';
        $blog->Tags = "created, first, welcome";
        $blog->Content = "<p>Thank you for registering with GenXYZ. Take a look around.</p><p>Visit our forum if you have questions or to answer questions other students may have.</p>";
        $blog->Status = "Published";
        $blog->ParentID = $blogHolder->ID;
        $blog->write();
        $blog->doRestoreToStage();
        
        return $blogHolder->ID;
    }
}