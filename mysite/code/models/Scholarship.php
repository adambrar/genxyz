<?php

class Scholarship extends DataObject {
    
    private static $db = array(
        'Name' => 'Varchar(100)',
        'Amount' => 'Varchar(10)',
        'Website' => 'Varchar(100)',
        'Provider' => 'Varchar(100)',
        'DueDate' => 'Date'
    );
    
    private static $searchable_fields = array(
        'Name',
        'Amount'
    );
    
    private static $summary_fields = array(
        'Name',
        'Amount'
    );
}