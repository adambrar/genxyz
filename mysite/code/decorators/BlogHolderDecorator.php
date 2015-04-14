<?php
class BlogHolderDecorator extends DataExtension {
     
    private static $has_one = array(
        'SideBarWidget' => 'WidgetArea'
    );
    
    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab("Root.Widgets", new WidgetAreaEditor("SideBarWidget"));
    }
}   