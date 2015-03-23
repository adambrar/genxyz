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
              
        $fields->addFieldToTab("Root.Main", new TextareaField('AboutStatement', 'About'), 'Content');      
        $fields->addFieldToTab("Root.Main", new TextareaField('MissionStatement', 'Mission Statement'), 'Content');
        $fields->addFieldToTab("Root.Main", new TextareaField('AboutValues', 'Values'), 'Content');
        
        $fields->removeByName("Content");

        return $fields;
    }
}
 
class AboutPage_Controller extends Page_Controller 
{
     
}