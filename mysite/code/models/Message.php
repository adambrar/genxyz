<?php

class Message extends DataObject {
    
    private static $db = array(
        'Content' => 'Text',
        'Viewed' => 'Boolean',
        'Author' => 'Enum("Agent,Student")'
    );
    
    private static $has_one = array(
        'Parent' => 'MessageThread'
    );
    
    private static $defaults = array(
        'Viewed' => false
    );
        
    private static $searchable_fields = array(
        'Parent.Title' => 'PartialMatchFilter',
        'Author.Name' => 'PartialMatchFilter'
    );
    
    private static $summary_fields = array(
        'Author' => 'Written by',
        'Content' => 'Content'
    );
        
    public function Writer() {
        if($this->Author == 'Agent') {
            return $this->Parent()->Agent();
        } else if($this->Author == 'Student') {
            return $this->Parent()->Student();
        }
        
        return false;
    }

}