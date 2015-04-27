<?php

class University extends DataObject {
    
    private static $db = array(
        'Title' => 'Varchar(100)',
        'Website' => 'Varchar(100)',
        'ContactName' => 'Varchar(50)',
        'ContactPhoneNumber' => 'Varchar(30)',
        'BusinessRegNumber' => 'Varchar(50)',
        'Address' => 'Varchar(40)'
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
}