<?php
class ForumHolderDecorator extends DataExtension {
    
    function NewestMember($limit = 1) {
       return Member::get()->filter(array(
            'MemberType' => 'Student'
        ))->sort('ID', 'DESC')->limit($limit);            
    }
}