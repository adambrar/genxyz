<?php

class Rating extends DataObject {
    
    private static $db = array(
        'Value' => 'Int',
        'Content' => 'Varchar(400)'
    );
    
    private static $has_one = array(
        'Rater' => 'Student',
        'Ratee' => 'Member'
    );
    
    private static $defaults = array(
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
    
        return $fields;
    }
    
}