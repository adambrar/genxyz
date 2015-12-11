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
        'School' => 'School'
    );
    
    private static $defaults = array(
    );
    
    private static $summary_fields = array(
        'ProgramName.Name' => 'Name',
        'School.Name' => 'School'
    );
    
    private static $searchable_fields = array(
        'ProgramName.Name' => 'PartialMatchFilter'
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
    
        return $fields;
    }
    
    public function getTitle() {
        return ProgramName::get()->ByID($this->ProgramNameID)->Name;
    }
    
    public static function getProgramOptions() {
        if($programs = ProgramName::get())
        {
            return $programs->map('ID', 'Title', 'Please Select');
        } else {
            return array('No Programs');
        }
    }
}