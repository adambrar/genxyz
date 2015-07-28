<?php
class BlogHolder_ControllerDecorator extends DataExtension {
     
    public function updateBlogEntryForm($form) {
        if(Member::currentUserID() != $this->owner->OwnerID) { 
            return $this->owner->httpError(403);
        }
        
        HTMLEditorField::include_js();

        $form->Fields()->removeByName('Author');        
        $form->Fields()->dataFieldByName('Title')->setTitle('Title');
        
        $form->Fields()->insertBefore(
            DropdownField::create('CategoryID', 'Category', 
                             BlogCategory::getBlogCategories())->setEmptyString('Select a category'), 'Tags');

        $form->Fields()->push(LiteralField::create(
            'InitTinyMCE', 
            '<script type="text/javascript">
            tinyMCE.init({
            theme : "advanced",
            mode: "textareas", 
            theme_advanced_toolbar_location : "top",
            theme_advanced_buttons1 : "bold,italic,underline,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,outdent,indent,separator,undo,redo",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            height:"400px",
            width:"100%"
            });
            setTimeout(function () { 
                tinyMCE.activeEditor.onKeyPress.add(function(){$("textarea").val(tinyMCE.activeEditor.getContent());});
                tinyMCE.activeEditor.onPaste.add(function(ed, e){$("textarea").val(tinyMCE.activeEditor.getContent());console.debug("pasted.");});
                }, 2000);
            </script>'));
        
        if($form->getValidator()->fieldIsRequired('Tags')) {
            $form->Fields()->dataFieldByName('Title')->setTitle('Second Title');
        }
        
        return $form;           
    }
    
}