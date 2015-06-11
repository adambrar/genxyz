<?php

class ISNetworkPage extends Page 
{
     private static $db = array(
         'About' => 'Text',
         'Services' => 'Text',
         'Media' => 'Text',
         'Interactive' => 'Text'
     );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
        
        $fields->addFieldToTab("Root.Main", new TextareaField('About', 'About'));      
        $fields->addFieldToTab("Root.Main", new TextareaField('Services', 'Services'));
        $fields->addFieldToTab("Root.Main", new TextareaField('Media', 'Media'));
        $fields->addFieldToTab("Root.Main", new TextareaField('Interactive', 'Interactive'));
        
        $fields->removeByName("Content");

        return $fields;
    }
}
 
class ISNetworkPage_Controller extends Page_Controller 
{
     function MemberName() {
         return Member::currentUser()->getName();
     }
}