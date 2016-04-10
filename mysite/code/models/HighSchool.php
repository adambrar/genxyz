<?php

class HighSchool extends DataObject {
    
    private static $db = array(
        'Title' => 'Varchar(100)',
    );
    
    private static $has_many = array(
        
    );
    
    public static function getHighSchoolOptions() {
        if($highSchools = DataObject::get("HighSchool"))
        {
            return $highSchools->map('ID', 'Title', 'Please Select');
        } else {
            return array('No High Schools');
        }
    }
    
    public static function getHighSchoolName($id) {
        if(!$id || !cytpe_digit($id))
            return false;
        
        $name = HighSchool::get()->ByID($id)->Name;
        if($name) {
            return $name;
        } else {
            return false;
        }
    }
    
}