<?php
class BlogEntryDecorator extends DataExtension {
    
    private static $has_one = array(
        'Category' => 'BlogCategory'
    );
    
    private static $defaults = array(
        'menuShown' => 'Student'
    );
    
    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab("Root.Main", DropdownField::create('CategoryID', 'Category', BlogCategory::getBlogCategories())->setEmptyString('Select a Category'));
    }

    function Author() {
        
        $member = Member::get()->byID($this->owner->BlogHolder->OwnerID);
        
        //if admin post return false
        if(!$member) { return false; }
        
        return $member;
    }
    
    function CurrentUserIsOwner() {
        return $this->owner->BlogHolder->OwnerID == Member::currentUserID();
    }
    
    public function Topic() {
        return BlogCategory::get()->byID($this->owner->CategoryID);
    }
}