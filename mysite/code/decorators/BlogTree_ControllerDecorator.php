<?php
class BlogTree_ControllerDecorator extends DataExtension {
    
    private static $allowed_actions = array(
        'topic'
    );
    
    public function getCategories() {
        if($this->owner->Title == "GenXYZ")
            return false;
        
        $categories = BlogCategory::get();
        
        return $categories;
    }
    
    public function SelectedCategory() {
        if($this->owner->request->latestParam('Action') == 'topic') {
            $topic = $this->owner->request->latestParam('ID');
            return urldecode($topic);
        }
        return '';
    }
    
    //if category selected, filter all entries by category, else select entries as normal
    public function EntriesByCategory($limit = null) {
        
        if($limit == null) $limit = BlogTree::$default_entries_limit;
        
        if($this->owner->request->latestParam('Action') == 'topic') {
            $BlogTopic = BlogCategory::get()->filter(
                'Title', urldecode($this->owner->request->latestParam('ID'))
            )->First();
            
            if(!$BlogTopic) {
                $entries = $this->owner->BlogEntries($limit);
            } else {
                $filter = array();
                $filter['CategoryID'] = $BlogTopic->ID;
                if($this->owner->ownerID) {
                    $filter['ParentID'] = $this->owner->ID;
                }
                
                $entries = BlogEntry::get()->filter($filter);
            }
        } else {
            $entries = $this->owner->BlogEntries($limit);
        }
        
        return $entries;
    }
    
    public function isCategorySelected($category) {
        if($this->owner->request->latestParam('Action') != 'topic') return false;
        
        if($this->owner->request->latestParam('ID') == $category) return true;
        
        return false;
    }
}