<?php

class EducationAdmin extends ModelAdmin {
    
    private static $managed_models = array(
        'HighSchool',
        'University',
        'Scholarship',
        'Program'
    );
    
    private static $url_segment = 'education';
    
    private static $menu_title = 'Education';
    
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