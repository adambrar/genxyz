<?php
class GroupRedirectLoginForm extends MemberLoginForm {
    
    private static $allowed_actions = array(
        'dologin',
        'LoginForm',
        'register'
    );
    
    function __construct($controller, $name, $fields = null, 
                         $actions = null, $checkCurrentUser = true) {
        //create your authenticator input here, e.g. username, but it could be any credentials
        //add your Authenticator to the form
        $fields = new FieldList(
            new TextField('Email', 'Email'),
            new PasswordField('Password', 'Password'),
            new CheckboxField("Remember", "Remember me next time?")
        );

        $actions = new FieldList(
            new FormAction('dologin', 'Log in')
        );
        
        if($controller->ClassName != "PartnersPortalPage") {
            $actions->push(LiteralField::create('register', '<a class="register-button button small" href="register">Register</a>'));
        }

        //LoginForm does its magic
        parent::__construct($controller, $name, $fields, $actions);
    }
    
    public function register($data) {
        $this->controller->redirect(Director::absoluteURL('register', true));
    }
    
    public function dologin($data) {
        if($this->performLogin($data)) {
                if(!$this->redirectByGroup($data))
                    $this->controller->redirect(Director::baseURL());
        } else {
            if($badLoginURL = Session::get("BadLoginURL")) {
                $this->controller->redirect($badLoginURL);
            } else {
                $this->controller->redirectBack();
            }
        }
    }
    
    public function redirectByGroup($data) {   
        // gets the current member that is logging in
        $member = Member::currentUser();
         
        // gets all the groups.
        $Groups = DataObject::get("Group");
         
        //cycle through each group  
        foreach($Groups as $Group)
        {
            //if the member is in the group and that group has GoToAdmin checked or GoToAcademicsPortal
            if($member && $member->inGroup($Group->ID) 
               && ($Group->GoToAdmin == 1 || $Group->GoToAcademicsPortal == 1)) 
            {   
                //redirect to the admin page
                if($Group->GoToAdmin) {
                    return $this->controller->redirect( Director::baseURL() . 'admin' );
                } else if($member->MemberType == 'Agent') {
                    $portalPage = PartnersPortalPage::get()->First()->Link();
                    return $this->controller->redirect( $portalPage . 'edit/agent/' . $member->ID );
                } else if($member->MemberType == 'University') {
                    $portalPage = PartnersPortalPage::get()->First()->Link();
                    return $this->controller->redirect( $portalPage . 'edit/university/' . $member->ID );
                }
            }
            //otherwise if the member is in the group and that group has a page linked
            elseif($member && $member->inGroup($Group->ID)  && $Group->LinkedPageID != 0) 
            {   
                //Get the page that is referenced in the group		
				$Link = DataObject::get_by_id("SiteTree", "{$Group->LinkedPageID}")->URLSegment;
				//direct to that page
                $this->controller->redirect( Director::baseURL() . $Link );
				return true;
            }
        }
        //if not found in group return false
        return false;
    }
}