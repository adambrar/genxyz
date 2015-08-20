<?php
class BlogEntryDecorator extends DataExtension {
    
    private static $has_one = array(
        'Category' => 'BlogCategory'
    );
    
    function authorProfileURL($authorID) {
        $profilePage = SiteTree::get()->filter(array(
            'ClassName' => 'MemberProfilePage',
            'Title' => 'MyProfile'
        ))->First();
        
        return $profilePage->Link('show') . '/' . $authorID;
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

}