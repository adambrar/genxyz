<?php

class StudentsAdmin extends ModelAdmin {
    
    private static $managed_models = array(
        'Member'
    );
    
    private static $url_segment = 'students';
    
    private static $menu_title = 'Students';
    
    public function getSearchContext() {
        $context = parent::getSearchContext();
        $fields = $context->getFields();

        $fields->push(new TextField('q[FirstName]', 'First Name'));
        $fields->push(new TextField('q[Surname]', 'Surname'));
        $fields->removeByName('q[Nickname]');

        $context->setFields($fields);
        
        return $context;
    }
    
    public function getList() {
        $list = parent::getList();

        $list = $list->exclude('MemberType', 'Agent');
        $list = $list->exclude('MemberType', 'University');
        
        $params = $this->request->requestVar('q');

        if(isset($params['FirstName']) && $params['FirstName']) {
            $list = $list->filter('FirstName:PartialMatch', $params['FirstName']);
        }

        if(isset($params['Surname']) && $params['Surname']) {
            $list = $list->filter('Surname:PartialMatch', $params['Surname']);
        }
        
        if(isset($params['Email']) && $params['Email']) {
            $list = $list->filter('Email:PartialMatch', $params['Email']);
        }

        return $list;
    }
}