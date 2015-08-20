<?php
class BlogTree_ControllerDecorator extends DataExtension {
     
    public function getCategories() {
        if($this->owner->Title == "GenXYZ")
            return false;
        
        $categories = BlogCategory::get();
        
        return $categories;
    }
}