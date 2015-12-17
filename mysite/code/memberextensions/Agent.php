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
        'FirstName' => 'PartialMatchFilter',
        'Surname' => 'PartialMatchFilter',
        'Country.Name' => 'PartialMatchFilter'
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $this->removeExtraFields($fields);
        
        $fieldList = array('Website', 'AddressLine1', 'AddressLine2', 'PostalCode', 'PhoneNumber', 'City', 'CountryID');
        
        foreach($fieldList as $field) {
            $tabField = $fields->dataFieldByName($field);
            $fields->removeFieldFromTab('Root.Main', $field);
            $fields->addFieldToTab('Root.Contact', $tabField);
        }
        
        $fields->dataFieldByName('Logo')->setFolderName('agents/'.$this->ID.'/Logos');
        
        return $fields;
    }
    
    /* 
     * Remove unused fields from member form in CMS
     */
    private function removeExtraFields(FieldList $fields) {
        
        $fields->removeByName('Country');
    }
    
    public function viewLink() {
        return SearchPage::get()->First()->Link('show/agent/'.$this->ID);
    }
    
    public function editLink() {
        return AgentPortalPage::get()->First()->Link('edit');
    }
    
    public function DoneApplications() {
        return $this->SchoolApplications()->filter('Status', 'Completed');
    }
    
    public function InProcessApplications() {
        return $this->SchoolApplications()->exclude('Status', 'Completed');
    }
}