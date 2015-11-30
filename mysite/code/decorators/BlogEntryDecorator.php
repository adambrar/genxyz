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
        $fields->addFieldToTab("Root.Main", new HtmlEditorField('Content', 'Content'));

    }

    function authorProfileURL($authorID) {
        $profilePage = StudentPortalPage::get()->First();
        
        return $profilePage ? $profilePage->Link('show') . '/' . $authorID : false;
    }
    
    function authorName() {
        //if admin post return false
        if($this->owner->BlogHolder->OwnerID == 1) { return false; }
        
        if($this->owner->BlogHolder->OwnerID == 0) { return "Anonymous Author"; }
        
        
        return Member::get()->byId( $this->owner->BlogHolder->OwnerID ) ? Member::get()->byId( $this->owner->BlogHolder->OwnerID )->getName() : "Anonymous Author";
    }
    
    function CurrentUserIsOwner() {
        return $this->owner->BlogHolder->OwnerID == Member::currentUserID();
    }
    
    public function Topic() {
        return BlogCategory::get()->byID($this->owner->CategoryID);
    }

}