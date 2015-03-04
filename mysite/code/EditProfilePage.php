<?php 
 
class EditProfilePage extends Page 
{
 
}
 
class EditProfilePage_Controller extends Page_Controller 
{
     private static $allowed_actions = array(
         'EditProfileForm',
         'Success',
         'Saved'
     );
    
    public function EditProfileForm()
    {
        $fields = new FieldList(
            new TextField('Name', '<span>*</span> Name'),
            new EmailField('Email', '<span>*</span> Email'),
            new TextField('JobTitle', 'Job Title'),
            new TextField('Website', 'Website(without http://'),
            new TextareaField('Blurb'),
            new ConfirmedPasswordField('Password', 'NewPassword')
        );
        
        $actions = new FieldList(
            new FormAction('SaveProfile', 'Save')
        );
        
        $validator = new RequiredFields('Name', 'Email');
        
        $Form = new Form($this, 'EditProfileForm', $fields, $actions, $validator);
 
        //Populate the form with the current members data
        $Member = Member::CurrentUser();
        $Form->loadDataFrom($Member->data());
         
        //Return the form
        return $Form;
    }
            
    //Save profile data from edit profile form
    private function SaveProfile($data, $form)
    {
        //Check for a logged in member
        if($CurrentMember = Member::CurrentUser())
        {
            //Check for another member with the same email address
            if($member = DataObject::get_one("Member", "Email = '". Convert::raw2sql($data['Email']) . "' AND ID != " . $CurrentMember->ID)) 
            {
                $form->addErrorMessage("Name", 'Sorry, that Name already exists.', "bad");
                     
                Session::set("FormInfo.Form_EditProfileForm.data", $data);
                     
                return $this->controller->redirectBack();
            }
            //Otherwise check that user IDs match and save
            else
            {
                $form->saveInto($CurrentMember); 
                 
                $CurrentMember->write();
 
                return $this->controller->redirect($this->Link('?saved=1'));                              
            }
        }
        //If not logged in then return a permission error
        else
        {
            return Security::PermissionFailure($this->controller, 'You must be <a href="register">registered</a> and logged in to edit your profile:');
        }
    }
    
    
    //Get 'saved' param. true if form data just saved
    public function Saved()
    {
        return $this->request->getVar('saved');
    }
    
    //Get success param. true if save was successful
    public function Success()
    {
        return $this->request->getVar('success');
    }
    
}