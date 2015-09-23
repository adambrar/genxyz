<?php

class Program extends DataObject {
    
    private static $db = array(
        'CertificateLink' => 'Varchar(200)',
        'DiplomaLink' => 'Varchar(200)',
        'DegreeLink' => 'Varchar(200)',
        'MastersLink' => 'Varchar(200)',
        'DoctorateLink' => 'Varchar(200)'
    );
    
    private static $has_one = array(
        'ProgramName' => 'ProgramName',
        'Institution' => 'Member'
    );
    
    private static $defaults = array(
    );
    
    private static $summary_fields = array(
        'ProgramName.Name' => 'Name',
        'Institution.BusinessName' => 'Institution'
    );
    
    private static $searchable_fields = array(
        'ProgramName.Name' => 'PartialMatchFilter'
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
        
//        $fields->removeByName('Institution');
//        $fields->addFieldToTab('Root.Main', DropdownField::create('InstitutionID', 'Institution', MemberDecorator::getInstitutionOptions())->setEmptyString('Select Institution'));
        return $fields;
    }
    
    public function getTitle() {
        return ProgramName::get()->ByID($this->ProgramNameID)->Name;
    }
    
    public static function getProgramOptions() {
        if($programs = Program::get())
        {
            return $programs->map('ID', 'Title', 'Please Select');
        } else {
            return array('No Programs');
        }
    }
}