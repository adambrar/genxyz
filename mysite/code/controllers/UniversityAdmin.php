<?php

class UniversityAdmin extends ModelAdmin {
    
    private static $managed_models = array(
        'Member'
    );
    
    private static $url_segment = 'university';
    
    private static $menu_title = 'University';
    
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
        $list = $list->exclude('MemberType', 'Agent');
        
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
    
    public function getEditForm($id = null, $fields = null)
    {
        $form = parent::getEditForm($id, $fields);

        $gridFieldName = 'Member';
        $gridField = $form->Fields()->fieldByName($gridFieldName);

        if ($gridField) {
            $gridField->getConfig()->addComponent(new GridFieldFilterHeader());
        }

        return $form;
    }
    
}