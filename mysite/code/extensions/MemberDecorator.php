<?php
class MemberDecorator extends DataExtension {
    
    private static $db = array(
        "MiddleName" => 'Varchar(50)',
        "DateOfBirth" => 'Date',
        "Nationality" => 'Varchar(100)',
        "Telephone" => 'Varchar(20)',
        "StreetAddress" => 'Varchar(100)',
        "Country" => 'Varchar(100)',
        "PostalCode" => 'Varchar(10)',
        "HSGradution" => 'Date',
        "UniversityGraduation" => 'Date'
    );
    
    private static $has_one = array(
        "HighSchool" => 'HighSchool',
        "University" => 'University',
        "City" => 'City'
    );
    
    public function updateCMSFields(FieldList $fields) 
    {
        $fields->addFieldToTab("Root.Main", new TextField('MiddleName', 'Middle Name'), 'surname');      
        $fields->addFieldToTab("Root.Profile", new TextField('DateOfBirth', 'Date of Birth'));      
        $fields->addFieldToTab("Root.Profile", new CountryDropdownField('Nationality', 'Nationality'));         
        $fields->addFieldToTab("Root.Profile", new TextField('Telephone', 'Telephone Number'));         
        $fields->addFieldToTab("Root.Profile", new TextField('StreetAddress', 'Street Address'));         
$fields->addFieldToTab("Root.Profile", new DropdownField('City', 'City', HighSchool::getHighSchoolOptions()));         
                $fields->addFieldToTab("Root.Profile", new CountryDropdownField('Country', 'Birth Country'));         
        $fields->addFieldToTab("Root.Profile", new TextField('PostalCode', 'Postal Code'));
        
        $fields->addFieldToTab("Root.Profile", new DropdownField('HighSchool', 'High School', HighSchool::getHighSchoolOptions()));         
        $fields->addFieldToTab("Root.Profile", new DateField('HSGraduation', 'Graduation'));         
        
        $fields->addFieldToTab("Root.Profile", new DropdownField('University', 'University', University::getUniversityOptions()));         
        $fields->addFieldToTab("Root.Profile", new DateField('UniversityGraduation', 'Graduation'));         
    }
    
    function Link()
    {
        if($ProfilePage = DataObject::get_one('EditProfilePage'))
        {
           return $ProfilePage->Link();
        }
    }
           
}