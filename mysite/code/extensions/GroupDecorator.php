<?php
class GroupDecorator extends DataExtension {
     
    private static $db = array(
        'GoToAdmin' => 'Boolean'
    );
    
    private static $has_one = array(
        'LinkedPage' => 'SiteTree'
    );
    
    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab("Root.Members", new TreeDropdownField("LinkedPageID", "Select a Page to redirect to after Login", "SiteTree"), 'Members');
        $fields->addFieldToTab("Root.Members", new CheckboxField("GoToAdmin", "Or go to Admin area after Login"), 'Members');
    }
}   