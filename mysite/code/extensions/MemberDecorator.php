<?php
class MemberDecorator extends DataExtension {
    
    private static $db = array(
        "Username" => "Varchar(100)",
        "MiddleName" => 'Varchar(50)',
        "DateOfBirth" => 'Date',
        "Nationality" => 'Varchar(100)',
        "Telephone" => 'Varchar(20)',
        "StreetAddress" => 'Varchar(100)',
        "Country" => 'Varchar(100)',
        "PostalCode" => 'Varchar(10)',
        "HSGraduation" => 'Date',
        "UniversityGraduation" => 'Date',
        "ContactFirstName" => 'Varchar(100)',
        "ContactSurname" => 'Varchar(100)',
        "ContactTelephone" => 'Varchar(100)',
        "ContactCountry" => 'Varchar(100)',
        "ContactEmail" => 'Varchar(100)'
    );
    
    private static $has_one = array(
        "HighSchool" => 'HighSchool',
        "University" => 'University',
        "City" => 'City',
        "ProfilePicture" => 'Image'
    );
    
    public function updateCMSFields(FieldList $fields) 
    {
        $fields->addFieldToTab("Root.Main", new TextField('MiddleName', 'Middle Name'), 'surname');      
        $fields->addFieldToTab("Root.Profile", new TextField('Username', 'Username'));      
        $fields->addFieldToTab("Root.Profile", new TextField('DateOfBirth', 'Date of Birth'));      
        $fields->addFieldToTab("Root.Profile", new CountryDropdownField('Nationality', 'Nationality'));         
        $fields->addFieldToTab("Root.Profile", new TextField('Telephone', 'Telephone Number'));         
        $fields->addFieldToTab("Root.Profile", new TextField('StreetAddress', 'Street Address'));         
$fields->addFieldToTab("Root.Profile", new DropdownField('City', 'City', HighSchool::getHighSchoolOptions()));         
        $fields->addFieldToTab("Root.Profile", new CountryDropdownField('Country', 'Birth Country'));         
        $fields->addFieldToTab("Root.Profile", new TextField('PostalCode', 'Postal Code'));
        
        $fields->addFieldToTab("Root.Profile", new DropdownField('HighSchoolID', 'High School', HighSchool::getHighSchoolOptions()));         
        $fields->addFieldToTab("Root.Profile", new DateField('HSGraduation', 'Graduation'));         
        
        $fields->addFieldToTab("Root.Profile", new DropdownField('UniversityID', 'University', University::getUniversityOptions()));         
        $fields->addFieldToTab("Root.Profile", new DateField('UniversityGraduation', 'Graduation'));         
    }
    
    function Link()
    {
        if($ProfilePage = DataObject::get_one('MemberProfilePage')->filter('AllowProfileEditing', '1'))
        {
           return $ProfilePage->Link();
        }
    }
    
}