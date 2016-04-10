<?php

class University extends DataObject {
    
    private static $db = array(
        'Title' => 'Varchar(100)'        
    );
    
    private static $has_many = array(
        
    );
    
    public static function getUniversityOptions() {
        $universities = DataObject::get("University");
        if($universities)
        {
            return $universities->map('ID', 'Title', 'Please Select');
        } else {
            return array('No Universities');
        }
    }
    
    public static function getUniversityName($id) {
        if(!$id || !cytpe_digit($id))
            return false;
        
        $name = Member::get()->ByID($id)->Name;
        if($name) {
            return $name;
        } else {
            return false;
        }
    }
}