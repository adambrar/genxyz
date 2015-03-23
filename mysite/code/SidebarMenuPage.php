<?php

class SidebarMenuPage extends Page 
{
     private static $defaults = array(
         'menuWelcome' => '0',
         'menuStudent' => '0',
         'menuUniversity' => '0',
         'menuStudentSidebar' => '1',
         'showDropdown' => '0'
     );
    
    private static $allowed_children = array(
        'SidebarMenuService'
    );
    
    static $can_be_root = false;
    
    
}
 
class SidebarMenuPage_Controller extends Page_Controller 
{
     
}