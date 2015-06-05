<?php

class MemberProfileViewerDecorator extends DataExtension {
    
    public function updateProfileViewer(&$customData) {
        $member = $customData['Member'];
        
        $customData['IsLoggedIn'] = Member::currentUserID();
        $customData['BlogEntries'] = $this->getLatestBlogEntries($member, 5);
        $customData['ForumPosts'] = $this->getLatestForumPosts($member, 5);

        return $customData;
    }
    
    //get latest blog posts for member
    public function getLatestBlogEntries($member = null, $max = 5) {
        if(!$member) {
            return false;
        }

        $holder = BlogHolder::get()->filter(array(
            'ownerID' => $member->ID
        ))->First();

        if(!$holder) {
            return false;
        }
        
        $entries = SiteTree::get()->filter(array(
            'ParentID' => $holder->ID
        ))->limit($max);
        
        return $entries;
    }
    
    public function getLatestForumPosts($member = null, $max = 5) {
        if(!$member) {
            return false;
        }
        
        $posts = Post::get()->filter(array(
            'AuthorID' => $member->ID
        ))->sort('Created', 'DESC')->limit($max);
        
        return $posts;
    }

}