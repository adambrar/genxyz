<?php

class Scholarship extends DataObject {
    
    private static $db = array(
        'Name' => 'Varchar(100)',
        'Amount' => 'Varchar(10)',
        'Website' => 'Varchar(100)'
    );
    
    private static $has_one = array(
        'University' => 'University'
    );
    
    
}