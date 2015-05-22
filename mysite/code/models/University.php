<?php

class University extends DataObject {
    
    private static $db = array(
        'Title' => 'Varchar(100)'        
    );
    
    private static $has_many = array(
        'Students' => 'Member'
    );
    
    public static function getUniversityOptions()
    {
        $universities = DataObject::get("University");
        if($universities)
        {
            return $universities->map('ID', 'Title', 'Please Select');
        } else {
            return array('No Universities');
        }
    }
}