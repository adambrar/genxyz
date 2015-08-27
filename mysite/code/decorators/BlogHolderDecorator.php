<?php
class BlogHolderDecorator extends DataExtension {
     
    private static $has_one = array(
        'SideBarWidget' => 'WidgetArea'
    );
    
    private static $defaults = array(
        'menuShown' => 'Student'
    );
    
    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab("Root.Widgets", new WidgetAreaEditor("SideBarWidget"));
    }
    
}