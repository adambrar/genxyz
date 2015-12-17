<?php
class BlogHolderDecorator extends DataExtension {
     
    private static $has_one = array(
        'SideBarWidget' => 'WidgetArea'
    );
    
    private static $belongs_to = array(
        'Student' => 'Student'
    );
    
    public function HolderEntries($limit = 10) {
        return SiteTree::get()->filter(array(
            'ClassName' => 'BlogEntry',
            'ParentID' => $this->owner->ID
        ))->sort('Created', 'DESC')->limit($limit);
    }
    
    public function viewOwnerProfile() {
        $page = StudentPortalPage::get()->First();
        return $page->Link('show/'.$this->OwnerID);
    }
    
    function CurrentUserIsOwner() {
        return $this->owner->OwnerID == Member::currentUserID();
    }
}