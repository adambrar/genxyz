<?php
class BlogEntryDecorator extends DataExtension {
    
    function authorProfileURL($authorID) {
        $profilePage = SiteTree::get()->filter('urlsegment', 'myprofile')->First();
        
        return $profilePage->Link('show') . '/' . $authorID;
    }
    
    function authorName() {
        return Member::get()->byId( BlogHolder::get()->byId($this->owner->ParentID)->OwnerID )->getName();
    }

}