<?php

class ServiceName extends DataObject {
    
    private static $db = array(
        'Name' => 'Varchar(100)'
    );
    
    private static $has_many = array(
        'Service' => 'Service'
    );
    
    private static $summary_fields = array(
        'Name' => 'Name'
    );
    
    private static $searchable_fields = array(
        'Name' => 'Name'
    );
    
}