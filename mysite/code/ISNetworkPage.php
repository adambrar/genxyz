<?php

class ISNetworkPage extends Page 
{
     private static $db = array(
         'About' => 'Text',
         'Services' => 'Text',
         'Media' => 'Text',
         'Interactive' => 'Text'
     );
    
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        
        $fields->addFieldToTab("Root.Main", new TextareaField('About', 'About'), 'Content');      
        $fields->addFieldToTab("Root.Main", new TextareaField('Services', 'Services'), 'Content');
        $fields->addFieldToTab("Root.Main", new TextareaField('Media', 'Media'), 'Content');
        $fields->addFieldToTab("Root.Main", new TextareaField('Interactive', 'Interactive'), 'Content');
        
        $fields->removeByName("Content");

        return $fields;
    }
}
 
class ISNetworkPage_Controller extends Page_Controller 
{
     
}