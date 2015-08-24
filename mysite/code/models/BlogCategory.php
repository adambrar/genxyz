<?php

class BlogCategory extends DataObject {
    
    private static $db = array(
        'Title' => 'Varchar(100)',
        'Description' => 'Text',
        'FontAwesomeIcon' => 'Varchar(100)'
    );
    
    private static $has_many = array(
        'BlogEntries' => 'BlogEntry'
    );
    
    private static $summary_fields = array(
        'Title' => 'Title',
        'Description' => 'Description'
    );
    
    private static $searchable_fields = array(
        'Title' => 'Title'
    );
    
    public static function getBlogCategories() {
        if(($categories = DataObject::get('BlogCategory')->sort('Title')))
        {
            return $categories->map('ID', 'Title', 'Please Select');
        } else {
            return array('No Categories');
        }
    }
}