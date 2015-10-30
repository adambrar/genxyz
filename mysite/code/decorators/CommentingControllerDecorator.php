<?php
class CommentingControllerDecorator extends DataExtension {
    
    function alterCommentForm($form) {
        $fields = $form->Fields();

        if(Member::currentUserID()) {
            $fields->removeByName('Name');
            $fields->removeByName('Email');
        }
        $fields->removeByName('URL');
        $fields->renameField('Comment', 'Comment');
            
        return $form->setFields($fields);
    }

}