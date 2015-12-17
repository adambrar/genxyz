<?php
class BlogHolder_ControllerDecorator extends DataExtension {
    
    public function updateBlogEntryForm($form) {
        if(Member::currentUserID() != $this->owner->OwnerID) { 
            return $this->owner->httpError(403);
        }
        
        HTMLEditorField::include_js();

        $form->Fields()->removeByName('Author');        
        $form->Fields()->dataFieldByName('Title')->setTitle('Title');
        
        $required = new RequiredFields(array(
            'Title',
            'Content'
        ));
        
        $form->setValidator($required);
        
        return $form;           
    }
    
}