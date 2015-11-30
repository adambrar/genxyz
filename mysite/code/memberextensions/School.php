<?php
/**
 *
 * School class extends Member for universities and other schools
 *
 */

class School extends Member {
    
    private static $db = array(
        'Website' => 'Varchar(200)',
        'Name' => 'Varchar(200)',
        'ContactName' => 'Varchar(100)',
        'ContactTelephone' => 'Varchar(20)',
        'RegistrationNumber' => 'Varchar(20)',
        'Type' => "Enum('University,College,Polytechnic,High School,IB School,Language School')",
        'Established' => 'Varchar(4)'
    );
    
    private static $has_one = array(
        'PartnersProfile' => 'PartnersProfile',
        'Logo' => 'Image',
        'Country' => 'Country',
        'City' => 'City'
    );
    
    private static $has_many = array(
        'Programs' => 'Program',
        'Applications' => 'SchoolApplication'
    );
    
    private static $many_many = array(
        'Schools' => 'School',
        'Agents' => 'Agent'
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $this->removeExtraFields($fields);
        
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
    
    public function ViewProfileLink() {
        $link = SearchPage::get()->First()->Link();
        return $link . 'show/school/' . $this->ID;
    }
}