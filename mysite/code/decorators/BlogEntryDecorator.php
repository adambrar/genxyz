<?php
class BlogEntryDecorator extends DataExtension {
    
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
        
        return $this->owner->BlogHolder->OwnerID ? Member::get()->byId( BlogHolder::get()->byId($this->owner->ParentID)->OwnerID )->getName() : "Anon";
    }

}