<?php

class Service extends DataObject {
    
    private static $db = array(
        'Description' => 'Text',
        'Cost' => 'Varchar(200)'
    );
    
    private static $has_one = array(
        'ServiceName' => 'ServiceName',
        'Agent' => 'Agent'
    );
    
    private static $defaults = array(
    );
    
    private static $summary_fields = array(
        'ServiceName.Name' => 'Name',
        'Agent.Name' => 'Agent',
        'Cost' => 'Cost'
    );
    
    private static $searchable_fields = array(
        'ServiceName.Name' => 'PartialMatchFilter',
        'Agent.Name' => 'PartialMatchFilter'
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
        
        $fields->removeByName('Agent');
        $fields->addFieldToTab('Root.Main', DropdownField::create('AgentID', 'Institution', MemberDecorator::getAgentOptions())->setEmptyString('Select Agent'));
        return $fields;
    }
    
    public function getTitle() {
        return ServiceName::get()->ByID($this->ServiceNameID)->Name;
    }
    
    public static function getServiceOptions() {
        if($service = Service::get())
        {
            return $service->map('ID', 'Title', 'Please Select');
        } else {
            return array('No Programs');
        }
    }
}