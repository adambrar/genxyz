<?php

class MessageThread extends DataObject {
    
    private static $db = array(
        'Title' => 'Varchar(200)'
    );
    
    private static $has_one = array(
        'Agent' => 'Agent',
        'Student' => 'Student'
    );
    
    private static $has_many = array(
        'Messages' => 'Message'
    );
    
    private static $searchable_fields = array(
        'Agent.Name' => 'PartialMatchFilter',
        'Student.FirstName' => 'PartialMatchFilter',
        'Title' => 'PartialMatchFilter'
    );
    
    private static $summary_fields = array(
        'Agent.Name' => 'Agent',
        'Student.Name' => 'Student',
        'Title' => 'Title'
    );

}