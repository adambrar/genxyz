<?php

class SidebarMenuService extends Page 
{
    private static $db = array(
        'Subtitle' => 'Varchar(100)',
        'Price' => 'Varchar(10)',
    );
    
    static $can_be_root = false;
    
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        
        $fields->addFieldToTab("Root.Main", new TextField('Subtitle', 'Subtitle'), 'Content');      
        $fields->addFieldToTab("Root.Main", new TextField('Price', 'Price'), 'Content');
        
        return $fields;
    }
}
 
class SidebarMenuService_Controller extends Page_Controller 
{
     
}