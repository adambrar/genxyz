<?php
class BlogEntryDecorator extends DataExtension {
    
    function authorProfileURL() {
        $profilePage = SiteTree::get()->filter('urlsegment', 'myprofile')->First();
        
        return false;//return $profilePage->Link('show') . '/' . $this->Parent()->getParent()->OwnerID;
    }

}