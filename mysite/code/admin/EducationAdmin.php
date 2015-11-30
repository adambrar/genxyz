<?php

class EducationAdmin extends ModelAdmin {
    
    private static $managed_models = array(
        'HighSchool',
        'University',
        'Scholarship'
    );
    
    private static $url_segment = 'education';
    
    private static $menu_title = 'Education';
    
    private static $menu_icon = 'mysite/icons/Letter_E_grey_Icon_16.png';

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