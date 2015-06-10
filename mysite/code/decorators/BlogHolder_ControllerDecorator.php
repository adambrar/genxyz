<?php
class BlogHolder_ControllerDecorator extends DataExtension {
     
    public function updateBlogEntryForm($form) {
        if(Member::currentUserID() != $this->owner->OwnerID) { 
            return $this->owner->httpError(404);
        }

        $form->Fields()->removeByName('Author');        
        $form->Fields()->dataFieldByName('Title')->setTitle('Title');
        
        return $form;           
    }
    
}