<?php 
 
class ScholarshipsPage extends Page 
{
     private static $db = array(
         'Message' => 'Text',
         'NumberShown' => 'Varchar(2)'
     );
    
    private static $defaults = array(
        'menuShown' => 'Student',
        'menuStudent' => true
    );
        
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
              
        $fields->addFieldToTab("Root.Main", new TextareaField('Message', 'Message'));      
        $fields->addFieldToTab("Root.Main", new NumericField('NumberShown', 'Number of Scholarships shown(max 99)'));
        
        $fields->removeByName("Content");

        return $fields;
    }
    
    public function getScholarships($limit = 20) {
        if($limit) {
            return Scholarship::get()->limit($limit);
        } else {
            return Scholarship::get();
        }
    }
    
    public function getAllScholarships() {
        return new PaginatedList(Scholarship::get(), Controller::curr()->request);
    }
}
 
class ScholarshipsPage_Controller extends Page_Controller 
{
    
    
}