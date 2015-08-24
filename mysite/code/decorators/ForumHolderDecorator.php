<?php
class ForumHolderDecorator extends DataExtension {
    
    private static $defaults = array(
        'menuShown' => 'Student',
    );
    
    function NewestMember($limit = 1) {
       return Member::get()->filter(array(
            'MemberType' => 'Student'
        ))->sort('ID', 'DESC')->limit($limit);            
    }
    
    public function updateCMSFields(FieldList $fields) {
        
        $fields->removeByName('ProfileSubtitle');
        $fields->removeByName('ProfileAbstract');
        $fields->removeByName('ProfileModify');
        $fields->removeByName('ProfileAdd');
        
    }
}