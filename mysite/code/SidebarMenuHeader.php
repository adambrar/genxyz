<?php

class SidebarMenuHeader extends Page 
{
    private static $defaults = array(
        'menuWelcome' => false,
        'menuStudent' => false,
        'menuUniversity' => false,
        'menuStudentSidebar' => true,
        'showDropdown' => true
    );
    
    private static $allowed_children = array(
        'SidebarMenuPage'
    );  
}
 
class SidebarMenuHeader_Controller extends Page_Controller 
{
     
}