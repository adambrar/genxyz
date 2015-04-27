<?php

class Country extends DataObject {
    
    private static $db = array(
        'Name' => 'Varchar(52)',
        'Code' => 'Varchar(3)'
    );
    
    private static $has_many = array(
        'Student' => 'Member'
    );
    
    public static function getCountryOptions()
    {
        if(!($cities = DataObject::get("Country")))
        {
            return $cities->map('Code', 'Name', 'Please Select');
        } else {
            return array('No Countries');
        }
    }
    
    public static function getCountryByCode($code)
    {
        $country = DataObject::get("Country")->filter('code', $code);
        
        if(!$country)
        {
            return false;
        } else {
            return $country->Name;
        }
    }
    
}