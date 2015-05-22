<?php

class Program extends DataObject {
    
    private static $db = array(
        'Name' => 'Varchar(100)',
        'Length' => 'Varchar(10)',
        'Website' => 'Varchar(100)'
    );
    
    private static $belongs_many_many = array(
        'Universities' => 'University'
    );
    
    
}