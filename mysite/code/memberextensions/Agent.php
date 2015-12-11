<?php
/**
 *
 * Homestay class extends Member for for agencies
 *
 */

class Agent extends Member {
    
    private static $db = array(
        'Website' => 'Varchar(200)',
        'AboutMe' => 'Varchar(200)',
        'AddressLine1' => 'Varchar(200)',
        'AddressLine2' => 'Varchar(200)',
        'City' => 'Varchar(200)',
        'PostalCode' => 'Varchar(10)',
        'PhoneNumber' => 'Varchar(20)'
    );
    
    private static $has_one = array(
        'Logo' => 'Image',
        'Nationality' => 'Country',
        'Country' => 'Country'
    );
    
    private static $has_many = array(
        'Services' => 'Service',
        'SchoolApplications' => 'SchoolApplication',
        'MessageThreads' => 'MessageThread'
    );
    
    private static $many_many = array(
        'Schools' => 'School'
    );
    
    private static $summary_fields = array(
        'Name' => 'Name',
        'Email' => 'Email',
        'Country.Name' => 'Country'
    );
    
    private static $searchable_fields = array(
        'Email' => 'PartialMatchFilter',
        'Name' => 'PartialMatchFilter',
        'Country.Name' => 'StartsWith'
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
    
    public function viewLink() {
        return SearchPage::get()->First()->Link('show/agent/'.$this->ID);
    }
    
    public function DoneApplications() {
        return $this->SchoolApplications()->filter('Status', 'Completed');
    }
    
    public function InProcessApplications() {
        return $this->SchoolApplications()->exclude('Status', 'Completed');
    }
}