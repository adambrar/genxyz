<?php

class City extends DataObject {
    
    private static $db = array(
        'Title' => 'Varchar(100)',
    );
    
    private static $has_many = array(
        'Student' => 'Member'
    );
    
    public static function getCityOptions()
    {
        if($cities = DataObject::get("City"))
        {
            return $cities->map('ID', 'Title', 'Please Select');
        } else {
            return array('No Cities');
        }
    }
    
}