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
    
    private static $summary_fields = array(
        'ContactName' => 'Contact Name',
        'Email' => 'Email',
        'Name' => 'Name of School'
    );
    
    private static $searchable_fields = array(
        'Email' => 'PartialMatchFilter',
        'Name' => 'PartialMatchFilter',
        'ContactName' => 'PartialMatchFilter',
        'Country.Name' => 'PartialMatchFilter'
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $this->removeExtraFields($fields);
        
        $fieldList = array('Website', 'ContactName', 'ContactTelephone', 'RegistrationNumber', 'Type', 'Established', 'Logo');
        
        foreach($fieldList as $field) {
            $tabField = $fields->dataFieldByName($field);
            $fields->removeFieldFromTab('Root.Main', $field);
            $fields->addFieldToTab('Root.Contact', $tabField);
        }
        
        $fields->dataFieldByName('Logo')->setFolderName('schools/'.$this->ID.'/Logos');
        
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
    }
    
    public function ViewLink() {
        $link = SearchPage::get()->First()->Link();
        return $link . 'show/school/' . $this->ID;
    }
    
    public function getProgramOptions() {
        if($programs = $this->Programs())
        {
            return $programs->map('ID', 'ProgramName.Name', 'Please Select');
        } else {
            return array('No Programs');
        }
    }
}