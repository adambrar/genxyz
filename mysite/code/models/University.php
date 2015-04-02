<?php

class University extends DataObject {
    
    private static $db = array(
        'Title' => 'Varchar(100)',
    );
    
    private static $has_many = array(
        'Student' => 'Member'
    );
    
    public static function getUniversityOptions()
    {
        if($universities = DataObject::get("University"))
        {
            return $universities->map('ID', 'Title', 'Please Select');
        } else {
            return array('No Universities');
        }
    }
    
    public function updateCMSFields(FieldList $fields)
    {        
        $fields->insertBefore("Root", new Tab('Test', 'Test'), 'Comments');
        
        return $fields;
    }
    
}