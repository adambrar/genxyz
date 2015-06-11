<?php 
 
class AboutPage extends Page 
{
     private static $db = array(
         'MissionStatement' => 'Text',
         'AboutStatement' => 'Text',
         'AboutValues' => 'Text'
     );
    
    private static $defaults = array(
        'menuShown' => 'Welcome',
        'menuWelcome' => true
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
              
        $fields->addFieldToTab("Root.Main", new TextareaField('AboutStatement', 'About'));      
        $fields->addFieldToTab("Root.Main", new TextareaField('MissionStatement', 'Mission Statement'));
        $fields->addFieldToTab("Root.Main", new TextareaField('AboutValues', 'Values'));
        
        $fields->removeByName("Content");

        return $fields;
    }
}
 
class AboutPage_Controller extends Page_Controller 
{
     
}