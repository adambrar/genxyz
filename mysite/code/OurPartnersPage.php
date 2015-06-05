<?php 
 
class OurPartnersPage extends Page 
{
     private static $db = array(
         'MainBlurb' => 'Text',
         'CollageBlurb' => 'Text',
         'SecondaryBlurb' => 'Text'
     );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->removeByName("Content");
              
        $fields->addFieldToTab("Root.Main", new TextareaField('MainBlurb', 'Main Blurb'));      
        $fields->addFieldToTab("Root.Main", new TextareaField('CollageBlurb', 'College Blurb'));
        $fields->addFieldToTab("Root.Main", new TextareaField('SecondaryBlurb', 'Secondary Blurb'));
        
        return $fields;
    }
}
 
class OurPartnersPage_Controller extends Page_Controller 
{
     
}