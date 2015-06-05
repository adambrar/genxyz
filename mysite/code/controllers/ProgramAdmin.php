<?php

class ProgramAdmin extends ModelAdmin {
    
    private static $managed_models = array(
        'ProgramName',
        'Program'
    );
    
    private static $url_segment = 'programs';
    
    private static $menu_title = 'Programs';
    
    private static $menu_icon = 'mysite/icons/Letter_P_grey_Icon_16.png';

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