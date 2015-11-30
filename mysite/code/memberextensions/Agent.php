<?php
/**
 *
 * Homestay class extends Member for for agencies
 *
 */

class Agent extends Member {
    
    private static $db = array(
        'Website' => 'Varchar(200)',
        'Name' => 'Varchar(200)',
        'ContactName' => 'Varchar(100)',
        'ContactTelephone' => 'Varchar(20)',
        'RegistrationNumber' => 'Varchar(20)',
    );
    
    private static $has_one = array(
        'PartnersProfile' => 'PartnersProfile',
        'Logo' => 'Image',
        'Country' => 'Country',
        'City' => 'City'
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
        'Country' => 'Country'
    );
    
    private static $searchable_fields = array(
        'Email' => 'PartialMatchFilter',
        'Name' => 'PartialMatchFilter'
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
    
    public function createProfilePage() {
        $this->PartnersProfile = PartnersProfile::create()->write();
        $this->write();
    }
    
    public function DoneApplications() {
        return $this->SchoolApplications()->filter('Status', 'Completed');
    }
    
    public function InProcessApplications() {
        return $this->SchoolApplications()->exclude('Status', 'Completed');
    }
}