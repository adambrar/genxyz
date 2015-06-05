<?php

class Country extends DataObject {
    
    private static $db = array(
        'Name' => 'Varchar(52)',
        'Code' => 'Varchar(3)'
    );
    
    private static $has_many = array(
        'Members' => 'Member'
    );
    
    public static function getCountryOptions() {
        if($countries = DataObject::get("Country")->sort('Name', 'ASC'))
        {
            return $countries->map('ID', 'Name', 'Please Select');
        } else {
            return array('No Countries');
        }
    }
    
    public static function getCountryByCode($code) {
        $country = DataObject::get("Country")->filter('code', $code);
        
        if(!$country)
        {
            return false;
        } else {
            return $country->Name;
        }
    }
    
    public static function getCountryName($id) {
        if(!$id || !cytpe_digit($id))
            return false;
        
        $name = Country::get()->ByID($id)->Name;
        if($name) {
            return $name;
        } else {
            return false;
        }
    }
    
}