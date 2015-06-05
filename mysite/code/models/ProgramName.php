<?php

class ProgramName extends DataObject {
    
    private static $db = array(
        'Name' => 'Varchar(100)'
    );
    
    private static $has_many = array(
        'Program' => 'Program'
    );
    
    private static $summary_fields = array(
        'Name' => 'Name',
        'ID' => 'ID'
    );
    
    private static $searchable_fields = array(
        'Name' => 'Name'
    );
    
}