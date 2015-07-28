<?php
class BlogTree_ControllerDecorator extends DataExtension {
     
    public function getCategories() {
        $categories = BlogCategory::get();
        
        return $categories;
    }
}