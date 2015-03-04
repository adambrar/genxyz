<?php 
 
class RegistrationPage extends Page 
{
 
}
 
class RegistrationPage_Controller extends Page_Controller 
{
     static $allowed_actions = array(
         'RegistrationForm'
     );
    
    //create registration form
    function RegistrationForm()
    {
        $fields = new FieldList(
            new TextField('Name', '<span>*</span> Name'),
            new EmailField('Email', '<span>*</span> Email'),
            new ConfirmedPasswordField('Password', '<span>*</span> Password')
        );
        
        $actions = new FieldList(
            new FormAction('doRegister', 'Register')
        );
        
        $validator = new RequiredFields('Name','Email','Password');
        
        return new Form($this, 'RegistrationForm', $fields, $actions, $validator);
    }

    function doRegister($data, $form)
    {
        //error if email in use
        if($member = DataObject::get_one("Member", "'Email' = '". Convert::raw2sql($data['Email']) ."'")) {
            //set error message
            $form->AddErorMessage('Email', "Sorry, that email address already exists. Please choose another one.");
            
            //refill form from submitted data
            Session::set("FormInfo.Form_RegistrationForm.data", $data);
            //go back to form
            return $this->controller->redirectBack();
        }
        
        //create new member
        $Member = new Member();
        $form->saveInto($Member);
        $Member->write();
        $Member->login();
        
         //Find or create the 'user' group
        if(!$userGroup = DataObject::get_one('Group', "Code = 'users'"))
        {
            $userGroup = new Group();
            $userGroup->Code = "users";
            $userGroup->Title = "Users";
            $userGroup->Write();
        }
        //Add member to user group
        $userGroup->Members()->add($Member);
         
        //Get profile page
        if($ProfilePage = DataObject::get_one('EditProfilePage'))
        {
            return $this->redirect($ProfilePage->Link('?success=1'));
        }
    }
        
}