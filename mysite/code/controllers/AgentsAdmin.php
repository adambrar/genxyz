<?php

class AgentsAdmin extends ModelAdmin {
    
    private static $managed_models = array(
        'Member'
    );
    
    private static $url_segment = 'agents';
    
    private static $menu_title = 'Agents';
    
    private static $menu_icon = 'mysite/icons/Letter_A_grey_Icon_16.png';
    
    public function getSearchContext() {
        $context = parent::getSearchContext();
        $fields = $context->getFields();

        $fields->push(new TextField('q[BusinessName]', 'Business Name'));
        $fields->push(new NumericField('q[BusinessRegistrationNumber]', 'Registration Number'));
        $fields->removeByName('q[Surname]');
        $fields->removeByName('q[FirstName]');
        $fields->removeByName('q[Nickname]');

        $context->setFields($fields);
        
        return $context;
    }
    
    public function getList() {
        $list = parent::getList();

        $list = $list->exclude('MemberType', 'Student');
        $list = $list->exclude('MemberType', 'University');
        
        $params = $this->request->requestVar('q');

        if(isset($params['BusinessName']) && $params['BusinessName']) {
            $list = $list->filter('BusinessName:PartialMatch', $params['BusinessName']);
        }

        if(isset($params['BusinessRegistrationNumber']) && $params['BusinessRegistrationNumber']) {
            $list = $list->filter('BusinessRegistrationNumber', $params['BusinessRegistrationNumber']);
        }
        
        if(isset($params['Email']) && $params['Email']) {
            $list = $list->filter('Email:PartialMatch', $params['Email']);
        }

        return $list;
    }
}