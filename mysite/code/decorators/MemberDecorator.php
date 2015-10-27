<?php
class MemberDecorator extends DataExtension {
    
    private static $db = array(
        'MemberType' => "Enum('Student, University, Agent')",
        'MiddleName' => 'Varchar(50)',
        'DateOfBirth' => 'Date',
        'Telephone' => 'Varchar(20)',
        'StreetAddress' => 'Varchar(100)',
        'PostalCode' => 'Varchar(10)',
        'Agency' => 'Varchar(100)',
        'HSGraduation' => 'Date',
        'UniversityGraduation' => 'Date',
        'ContactFirstName' => 'Varchar(100)',
        'ContactSurname' => 'Varchar(100)',
        'ContactTelephone' => 'Varchar(100)',
        'BusinessWebsite' => 'Varchar(100)',
        'BusinessName' => 'Varchar(100)',
        'BusinessContact' => 'Varchar(100)',
        'BusinessTelephone' => 'Varchar(20)',
        'BusinessRegistrationNumber' => 'Varchar(30)',
        'PointsEarned' => 'Varchar(5)'
    );
    
    private static $has_one = array(
        'HighSchool' => 'HighSchool',
        'University' => 'University',
        'PartnersProfile' => 'PartnersProfile',
        'ProfilePicture' => 'Image',
        'BusinessLogo' => 'Image',
        'Nationality' => 'Country',
        'CurrentCountry' => 'Country',
        'ContactCountry' => 'Country',
        'BusinessCountry' => 'Country',
        'City' => 'City'
    );
    
    private static $has_many = array(
        'Programs' => 'Program',
        'Services' => 'Service'
    );
    
    private static $many_many = array(
        'Agents' => 'Member',
        'Schools' => 'Member'
    );

    private static $searchable_fields = array(
        'BusinessName' => 'BusinessName',
        'HighSchoolID' => 'HighSchool',
        'UniversityID' => 'University'
    );
    
    public function isStudent(Member $member = null) {
        if(!$member) {
            return $this->owner->MemberType == "Student";
        } else {
            return $member->MemberType == "Student";
        }
    }
    
    public function isAgent(Member $member = null) {
        if(!$member) {
            return $this->owner->MemberType == "Agent";
        } else {
            return $member->MemberType == "Agent";
        }    }
    
    public function isUniversity(Member $member = null) {
        if(!$member) {
            return $this->owner->MemberType == "University";
        } else {
            return $member->MemberType == "University";
        }
    }
    
    //profile page link
    public static function viewProfileLink($id = null) {
        if(!$id) {
            return false;
        }

        $member = Member::get()->byID($id);
        
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
    
    public function showProfilePageLink($id = null) {
        if(!$id) return false;
        
        $member = Member::get()->byID($id);
        
        if(!$member) {
            return false;
        }
        
        if($member->isUniversity()) {
            $academicsPage = AcademicsPage::get()->First();
            return $academicsPage->Link() . 'show/university/' . $member->ID;
        } else if($member->isAgent()) {
            $academicsPage = AcademicsPage::get()->First();
            return $academicsPage->Link() . 'show/agent/' . $member->ID;
        } else if($member->isStudent()) {
            return $profilePage = MemberProfilePage::get()->filter(array(
                'AllowRegistration' => '0',
                'AllowProfileEditing' => '1'
            ))->First()->Link('show') . '/' . $member->ID;
        }
    }
        
    // get business logo
    public function getLogoFile($ID = null) {
        if(!$ID) { $ID = Member::currentUser()->BusinessLogoID; }
        $Logo = File::get()->filter(array(
            'ClassName' => 'Image',
            'ID' => $ID
        ))->First();

        if(!$Logo) {
            return File::get()->filter(array(
                'Title' => 'DefaultProfilePicture'
            ))->First();
        } else {
            return $Logo;
        }
    }
    
    // get profile picture
    public function ProfilePictureLink($ID = null) {
        if(!$ID) {
            return File::get()->filter(array(
                'Title' => 'DefaultProfilePicture'
            ))->First()->Filename;
        }
        
        $profilePicture = File::get()->filter(array(
            'ClassName' => 'Image',
            'ID'        => $ID
        ))->First();

        if(!$profilePicture) {
            return File::get()->filter(array(
                'Title' => 'DefaultProfilePicture'
            ))->First()->Filename;
        } else {
            return $profilePicture->Filename;
        }
    }
    
    public function getLatestForumPosts($max = null) {
        if(!Member::currentUserID()) {
            return false;
        }
        if($max) {
            $posts = Post::get()->filter(array(
                'AuthorID' => $this->owner->ID
            ))->sort('Created', 'DESC')->limit($max);
        } else {
            $posts = Post::get()->filter(array(
                'AuthorID' => $this->owner->ID
            ))->sort('Created', 'DESC');
        }
        
        return $posts ? $posts : false;
    }
    
    public static function getInstitutionOptions() {
        if($institutions = Member::get()->filter('MemberType','University'))
        {
            return $institutions->map('ID', 'BusinessName', 'Please Select');
        } else {
            return array('No Institutions');
        }
    }
    
    public static function getAgentOptions() {
        if($institutions = Member::get()->filter('MemberType','Agent'))
        {
            return $institutions->map('ID', 'BusinessName', 'Please Select');
        } else {
            return array('No Institutions');
        }
    }
    
    public function getBlogHolder() {
        if(!Member::currentUserID()) {
            return Controller::curr()->httpError(403);
        }
        
        $holder = BlogHolder::get()->filter(array(
            'ownerID' => $this->owner->ID
        ))->First();
        
        return $holder ? $holder : false;
    }
        
    
    //get latest blog posts for member
    public function getLatestBlogEntries($member = null, $max = 5) {
        if(!$member) {
            return false;
        }

        $holder = BlogHolder::get()->filter(array(
            'ownerID' => $member->ID
        ))->First();

        if(!$holder) {
            return false;
        }
        
        $entries = SiteTree::get()->filter(array(
            'ParentID' => $holder->ID
        ))->limit($max);
        
        return $entries;
    }
    
    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab('Root.Main', DropdownField::create('MemberType', 'Member Type', singleton('Member')->dbObject('MemberType')->enumValues())->setEmptyString('Select Member Type'), 'FirstName');
        $this->removeExtraFields($fields);
        
        //customize CMS fields depending on member type
        if($this->owner->MemberType == "Student") {
            $this->addStudentFields($fields);
            $fields->removeByName('Programs');
            $fields->removeByName('Schools');
            $fields->removeByName('Agents');
            $fields->removeByName('Services');
            $fields->removeByName('BusinessWebsite');
            $fields->removeByName('BusinessName');
            $fields->removeByName('BusinessContact');
            $fields->removeByName('BusinessTelephone');
            $fields->removeByName('BusinessRegistrationNumber');
            $fields->removeByName('BusinessCountryID');
            $fields->removeByName('PartnersProfileID');
            $fields->removeByName('BusinessLogoID');
        } else if($this->owner->MemberType == "Agent") {
            $this->addBusinessFields($fields);
            $fields->removeByName('Programs');
            $fields->removeByName('Agents');
            $this->removeStudentFields($fields);
        } else if($this->owner->MemberType == "University") {
            $this->addBusinessFields($fields);
            $fields->removeByName('Services');
            $this->removeStudentFields($fields);
        } else {
            $this->addStudentFields($fields);
            $this->addBusinessFields($fields);
        }
    }
    
    private function addStudentFields(FieldList $fields) {
        $fields->addFieldToTab('Root.Main', new TextField('PointsEarned', 'Points Earned'), 'Email');
        
        $fields->addFieldToTab('Root.Profile', new TextField('FirstName', 'First Name'));
        $fields->addFieldToTab('Root.Profile', new TextField('MiddleName', 'Middle Name'));
        $fields->addFieldToTab('Root.Profile', new TextField('Surname', 'Surname'));

        $fields->addFieldToTab('Root.Profile', new DateField('DateOfBirth', 'Date of Birth'));      
        $fields->addFieldToTab('Root.Profile', DropdownField::create('NationalityID', 'Nationality', Country::getCountryOptions())->setEmptyString('Select a country'));
        $fields->addFieldToTab('Root.Profile', new TextField('Telephone', 'Telephone Number'));         
        $fields->addFieldToTab('Root.Profile', new TextField('StreetAddress', 'Street Address'));         
        $fields->addFieldToTab('Root.Profile', new DropdownField('CityID', 'City', City::getCityOptions()));         
        $fields->addFieldToTab('Root.Profile', DropdownField::create('CurrentCountryID', 'Current Country', Country::getCountryOptions())->setEmptyString('Select a country'));         
        $fields->addFieldToTab('Root.Profile', new TextField('PostalCode', 'Postal Code'));
        $fields->addFieldToTab('Root.Education', new DropdownField('HighSchoolID', 'High School', HighSchool::getHighSchoolOptions()));         
        $fields->addFieldToTab('Root.Education', new DateField('HSGraduation', 'Graduation'));        
        $fields->addFieldToTab('Root.Education', new DropdownField('UniversityID', 'University', University::getUniversityOptions())); 
        $fields->addFieldToTab('Root.Education', new DateField('UniversityGraduation', 'Graduation'));         
        $fields->addFieldToTab('Root.Education', new TextField('Agency', 'Agency'));         

        $fields->addFieldToTab('Root.EmergencyContant', new TextField('ContactFirstName', 'Contact First Name'));
        $fields->addFieldToTab('Root.EmergencyContant', new TextField('ContactSurname', 'Contact Surname'));
        $fields->addFieldToTab('Root.EmergencyContant', new TextField('ContactTelephone', 'Contact Telephone'));
        $fields->addFieldToTab('Root.EmergencyContant', DropdownField::create('ContactCountryID', 'Contact Country', Country::getCountryOptions())->setEmptyString('Select a country'));
        $fields->addFieldToTab('Root.EmergencyContant', new EmailField('ContactEmail', 'Contact Email'));
    }
    
    private function addBusinessFields(FieldList $fields) {
        $fields->addFieldToTab('Root.BusinessInfo', new TextField('BusinessName', 'Business Name'));         
        $fields->addFieldToTab('Root.BusinessInfo', new TextField('BusinessWebsite', 'Website'));         
        $fields->addFieldToTab('Root.BusinessInfo', new TextField('BusinessContact', 'Contact Name'));         
        $fields->addFieldToTab('Root.BusinessInfo', new TextField('BusinessTelephone', 'Contact Telephone'));         
        $fields->addFieldToTab('Root.BusinessInfo', DropdownField::create('BusinessCountryID', 'Country of Registration', Country::getCountryOptions())->setEmptyString('Select a country'));
        $fields->addFieldToTab('Root.BusinessInfo', new TextField('BusinessRegistrationNumber', 'Business Registration Number'));         
        $fields->addFieldToTab('Root.BusinessInfo', new HiddenField('PartnersProfileID', 'Partners Profile ID'));         
    }
    
    private function removeStudentFields(FieldList $fields) {
        $fields->removeByName('MiddleName');
        $fields->removeByName('DateOfBirth');
        $fields->removeByName('Telephone');
        $fields->removeByName('StreetAddress');
        $fields->removeByName('PostalCode');
        $fields->removeByName('Agency');
        $fields->removeByName('HSGraduation');
        $fields->removeByName('UniversityGraduation');
        $fields->removeByName('ContactFirstName');
        $fields->removeByName('ContactSurname');
        $fields->removeByName('ContactTelephone');
        $fields->removeByName('PointsEarned');
        $fields->removeByName('HighSchoolID');
        $fields->removeByName('UniversityID');
        $fields->removeByName('ProfilePicture');
        $fields->removeByName('NationalityID');
        $fields->removeByName('CurrentCountryID');
        $fields->removeByName('ContactCountryID');
        $fields->removeByName('CityID');
    }
    
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
    }
    
}