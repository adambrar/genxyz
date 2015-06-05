<?php

class Agent extends DataObject {
    
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
    
    public static function getAgentOptions() {
        $agents = DataObject::get("Agent");
        if($agents)
        {
            return $agents->map('ID', 'Title', 'Please Select');
        } else {
            return array('No Agents');
        }
    }
}