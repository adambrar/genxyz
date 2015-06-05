<?php

class Program extends DataObject {
    
    private static $db = array(
        'Length' => "Enum('1 year, 2 years, 3 years, 4 years, 5 years')",
        'Link' => 'Varchar(100)'
    );
    
    private static $belongs_many_many = array(
        'Members' => 'Member'
    );
    
    private static $has_one = array(
        'ProgramName' => 'ProgramName'
    );
    
    private static $defaults = array(
        'Length' => '4 years'
    );
    
    private static $summary_fields = array(
        'ProgramName.Name' => 'Name',
        'Link' => 'Link',
        'Length' => 'Length'
    );
    
    private static $searchable_fields = array(
        'Link' => 'Link',
        'Length' => 'Length'
    );
    
    public function getTitle() {
        return ProgramName::get()->ByID($this->ProgramNameID)->Name;
    }
    
    public static function getProgramOptions() {
        if($programs = Program::get())
        {
            return $programs->map('ID', 'Title', 'Please Select');
        } else {
            return array('No Countries');
        }
    }
}