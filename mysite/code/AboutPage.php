<?php 
 
class AboutPage extends Page 
{
     private static $db = array(
         'MissionStatement' => 'Text',
         'AboutStatement' => 'Text',
         'AboutValues' => 'Text'
     );
    
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName("Content");
              
        $fields->addFieldToTab("Root.Main", new TextareaField('AboutStatement', 'About'));      
        $fields->addFieldToTab("Root.Main", new TextareaField('MissionStatement', 'Mission Statement'));
        $fields->addFieldToTab("Root.Main", new TextareaField('AboutValues', 'Values'));
        
        return $fields;
    }
}
 
class AboutPage_Controller extends Page_Controller 
{
     
}