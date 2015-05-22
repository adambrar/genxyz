<?php
class MemberDecorator extends DataExtension {
    
    private static $db = array(
        'MemberType' => "Enum('Student, University, Agent')",
        'MiddleName' => 'Varchar(50)',
        'DateOfBirth' => 'Date',
        'Telephone' => 'Varchar(20)',
        'StreetAddress' => 'Varchar(100)',
        'PostalCode' => 'Varchar(10)',
        'HSGraduation' => 'Date',
        'UniversityGraduation' => 'Date',
        'ContactFirstName' => 'Varchar(100)',
        'ContactSurname' => 'Varchar(100)',
        'ContactTelephone' => 'Varchar(100)',
        'BusinessWebsite' => 'Varchar(100)',
        'BusinessName' => 'Varchar(100)',
        'BusinessContact' => 'Varchar(100)',
        'BusinessTelephone' => 'Varchar(20)',
        'BusinessRegistrationNumber' => 'Varchar(30)'
    );
    
    private static $has_one = array(
        'HighSchool' => 'HighSchool',
        'University' => 'University',
        'PartnersProfile' => 'PartnersProfile',
        'ProfilePicture' => 'Image',
        'Nationality' => 'Country',
        'CurrentCountry' => 'Country',
        'ContactCountry' => 'Country',
        'City' => 'City'
    );
    
    private static $summary_fields = array(
        'BusinessName',
        'BusinessContact',
        'MemberType'
    );
    
    public function updateCMSFields(FieldList $fields) 
    {
        $fields->addFieldToTab('Root.Main', DropdownField::create('MemberType', 'Member Type', singleton('Member')->dbObject('MemberType')->enumValues())->setEmptyString('Select Member Type'), 'FirstName');

        $fields->removeByName('FirstName');
        $fields->removeByName('Surname');
        
        
        $this->addStudentFields($fields);
        $this->addBusinessFields($fields);
        

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
    
    function Link()
    {
        if($ProfilePage = DataObject::get_one('MemberProfilePage')->filter('AllowProfileEditing', '1'))
        {
           return $ProfilePage->Link();
        }
    }
    
    private function addStudentFields(FieldList $fields)
    {
         $fields->addFieldToTab('Root.Profile', new TextField('FirstName', 'First Name'));
        $fields->addFieldToTab('Root.Profile', new TextField('MiddleName', 'Middle Name'));
        $fields->addFieldToTab('Root.Profile', new TextField('Surname', 'Surname'));

        $fields->addFieldToTab('Root.Profile', new DateField('DateOfBirth', 'Date of Birth'));      
        $fields->addFieldToTab('Root.Profile', new DropdownField('Nationality', 'Nationality', Country::getCountryOptions()));         
        $fields->addFieldToTab('Root.Profile', new TextField('Telephone', 'Telephone Number'));         
        $fields->addFieldToTab('Root.Profile', new TextField('StreetAddress', 'Street Address'));         
        $fields->addFieldToTab('Root.Profile', new DropdownField('City', 'City', City::getCityOptions()));         
        $fields->addFieldToTab('Root.Profile', new DropdownField('Country', 'Current Country', Country::getCountryOptions()));         
        $fields->addFieldToTab('Root.Profile', new TextField('PostalCode', 'Postal Code'));
        $fields->addFieldToTab('Root.Profile', new DropdownField('HighSchoolID', 'High School', HighSchool::getHighSchoolOptions()));         
        $fields->addFieldToTab('Root.Profile', new DateField('HSGraduation', 'Graduation'));        
        $fields->addFieldToTab('Root.Profile', new DropdownField('UniversityID', 'University', University::getUniversityOptions())); 
        $fields->addFieldToTab('Root.Profile', new DateField('UniversityGraduation', 'Graduation'));         

        $fields->addFieldToTab('Root.EmergencyContant', new TextField('ContactFirstName', 'Contact First Name'));
        $fields->addFieldToTab('Root.EmergencyContant', new TextField('ContactSurname', 'Contact Surname'));
        $fields->addFieldToTab('Root.EmergencyContant', new TextField('ContactTelephone', 'Contact Telephone'));
        $fields->addFieldToTab('Root.EmergencyContant', new DropdownField('ContactCountry', 'Contact Country', Country::getCountryOptions()));
        $fields->addFieldToTab('Root.EmergencyContant', new EmailField('ContactEmail', 'Contact Email'));
    }
    
    private function addBusinessFields(FieldList $fields)
    {
        $fields->addFieldToTab('Root.Business', new TextField('BusinessName', 'Business Name'));         
        $fields->addFieldToTab('Root.Business', new TextField('BusinessWebsite', 'Website'));         
        $fields->addFieldToTab('Root.Business', new TextField('BusinessContact', 'Contact Name'));         
        $fields->addFieldToTab('Root.Business', new TextField('BusinessCountry', 'Country of Registration'));
        $fields->addFieldToTab('Root.Business', new TextField('BusinessRegistrationNumber', 'Business Registration Number'));         
    }
    
}