<?php

class SchoolApplication extends DataObject {
    
    private static $db = array(
        'Notes' => 'Text',
        'Status' => 'Enum("Completed,Processing,Incomplete")'
    );
    
    private static $has_one = array(
        'Agent' => 'Agent',
        'Student' => 'Student',
        'School' => 'School'
    );
    
    private static $has_many = array(
        'StudentFiles' => 'File'
    );
    
    private static $searchable_fields = array(
        'Agent.FirstName' => 'StartsWith',
        'Agent.Surname' => 'StartsWith',
        'Student.FirstName' => 'StartsWith',
        'Student.Surname' => 'StartsWith',
        'School.Name' => 'PartialMatchFilter'
    );
    
    private static $summary_fields = array(
       'Agent.Name' => 'Agent',
        'Student.Name' => 'Student',
        'School.Name' => 'School'
    );
    
    public function StatusClass() {
        switch($this->Status) {
            case "Completed":
                return "list-group-item-success";
                break;
            case "Processing":
                return "list-group-item-info";
                break;
            case "Incomplete":
                return "list-group-item-warning";
                break;
            case "Error":
                return "list-group-item-danger";
                break;
            default:
                return "list-group-item-default";
                break;
        }
    }

}