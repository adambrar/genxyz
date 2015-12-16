<?php

class ProgramName extends DataObject {
    
    private static $db = array(
        'Name' => 'Varchar(100)',
        'Summary' => 'Text'
    );
    
    private static $has_many = array(
        'Program' => 'Program'
    );
    
    private static $summary_fields = array(
        'Name' => 'Name'
    );
    
    private static $searchable_fields = array(
        'Name' => 'Name'
    );
    
    public static function getProgramNameOptions() {
        if($programs = ProgramName::get())
        {
            return $programs->map('ID', 'Title', 'Please Select');
        } else {
            return array('No Programs');
        }
    }
}