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
        return BlogHolder::get()->byId($this->owner->ParentID)->OwnerID ? Member::get()->byId( BlogHolder::get()->byId($this->owner->ParentID)->OwnerID )->getName() : "Anon";
    }

}