<?php

class MemberProfileViewerDecorator extends DataExtension {
    
    public function updateProfileViewer(&$customData)
    {
        $member = $customData['Member'];
        
        $customData['IsLoggedIn'] = Member::currentUserID();
        $customData['BlogEntries'] = $this->getLatestBlogEntries($member, 5);
        
        return $customData;
    }
    
    //get latest blog posts for member
    public function getLatestBlogEntries($member = null, $max = 5)
    {
        if(!$member) {
            return false;
        }
        
        $holder = BlogHolder::get()->filter(array(
            'ownerID' => $member->ID
        ))->First();
        
        if(!$holder) {
            return false;
        }
        
        return SiteTree::get()->filter(array(
            'ParentID' => $holder->ID
        ))->limit($max);
    }
}