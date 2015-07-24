<?php

class BlogCategoryAdmin extends ModelAdmin {
    
    private static $managed_models = array(
        'BlogCategory'
    );
    
    private static $url_segment = 'blogCategory';
    
    private static $menu_title = 'Blog Categories';
    
    public function getSearchContext() {
        $context = parent::getSearchContext();
        $fields = $context->getFields();

        $context->setFields($fields);
        
        return $context;
    }
    
    public function getList() {
        $list = parent::getList();

        return $list;
    }
    
}