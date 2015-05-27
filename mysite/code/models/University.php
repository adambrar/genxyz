<?php

class University extends DataObject {
    
    private static $db = array(
        'Title' => 'Varchar(100)'        
    );
    
    private static $has_many = array(
        'Students' => 'Member',
    );
    
    private static $many_many = array(
        'Programs' => 'Program'
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