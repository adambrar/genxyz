<?php

class ServiceAdmin extends ModelAdmin {
    
    private static $managed_models = array(
        'ServiceName',
        'Service'
    );
    
    private static $url_segment = 'services';
    
    private static $menu_title = 'Services';
    
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