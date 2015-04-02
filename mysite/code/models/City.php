<?php

class City extends DataObject {
    
    private static $db = array(
        'Name' => 'Varchar(100)',
    );
    
    private static $has_many = array(
        'Student' => 'Member'
    );
    
    public static function getCityOptions()
    {
        if($cities = DataObject::get("City"))
        {
            return $cities->map('ID', 'Name', 'Please Select');
        } else {
            return array('No Cities');
        }
    }
    
}