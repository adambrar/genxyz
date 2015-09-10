<?php 
 
class TermsAndConditionsPage extends Page 
{
     private static $db = array(
         'Terms' => 'HTMLText',
     );
    
    private static $defaults = array(
        'menuShown' => 'None',
        'menuWelcome' => false
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
              
        $fields->addFieldToTab("Root.Main", new HTMLEditorField('Terms', 'Terms'));              
        $fields->removeByName("Content");

        return $fields;
    }
}
 
class TermsAndConditionsPage_Controller extends Page_Controller 
{
     
}