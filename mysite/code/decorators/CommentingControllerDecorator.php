<?php
class CommentingControllerDecorator extends DataExtension {
    
    function alterCommentForm($form)
    {
        $member = Member::currentUser();
        if(!$member || $member->MemberType != "Student") {
            
            $fields = new FieldList(
                new LiteralField('CantComent', '<p>You need to be logged in to comment.</p>'),
                new LiteralField('Buttons', '<a href="Security/login" class="button small">Login</a> || <a href="register" class="button small">Register</a>')
            );
            $form->setActions(new FieldList());
        } else {
            $fields = $form->Fields();
            $fields->removeByName('Name');
            $fields->removeByName('Email');
            $fields->removeByName('URL');
            $fields->renameField('Comment', 'Comment');
        }
            
        return $form->setFields($fields);
    }

}