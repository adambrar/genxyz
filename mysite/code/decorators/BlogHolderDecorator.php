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

    public function HolderEntries($limit = 10) {
        return SiteTree::get()->filter(array(
            'ClassName' => 'BlogEntry',
            'ParentID' => $this->owner->ID
        ))->sort('Created', 'DESC')->limit($limit);
    }
    
}