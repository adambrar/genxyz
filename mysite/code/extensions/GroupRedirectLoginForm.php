<?php
class GroupRedirectLoginForm extends MemberLoginForm {
    
    private static $allowed_actions = array(
        'dologin',
        'LoginForm'
    );
    
    function __construct($controller, $name, $fields = null, 
                         $actions = null, $checkCurrentUser = true) {
        if(!$fields) {
            $fields = new FieldList(
                new TextField('Email', 'Email'),
                new PasswordField('Password', 'Password'),
                new CheckboxField('Remember', 'Remember me next time?')
            );
        }
        if(!$actions) {
            $actions = new FieldList(
                FormAction::create('dologin', 'Log in')->addExtraClass('login-button btn btn-primary')
            );
        
        
            if($controller->ClassName == "AgentPortalPage" ||
              $controller->ClassName == "SchoolPortalPage" || 
             $controller->ClassName == "StudentPortalPage") {
                $actions->push(LiteralField::create('register', '<a data-toggle="tab" class="btn btn-default" href="#register">Register</a>'));
            } else {
                $actions->push(LiteralField::create('register', '<a class="btn btn-default" href="student">Register</a>'));
            }
                $actions->push(new LiteralField('forgotPassword', '<p id="forgotPassword"><a href="Security/lostpassword">I lost my password!</a></p>'));
        }
                           
        //LoginForm does its magic
        parent::__construct($controller, $name, $fields, $actions);
    }
    
    public function dologin($data) {
        Debug::show(Session::get("BadLoginURL"));
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
        
        if($member) {
            if(Permission::check('ADMIN')) {
                return $this->controller->redirect( Director::baseURL() . 'admin' );                               
            } else if(Permission::check('EDIT_AGENT')) {
                $agentPage = AgentPortalPage::get()->First()->Link('edit');
                return $this->controller->redirect( $agentPage );
            } else if(Permission::check('EDIT_SCHOOL')) {
                $schoolPage = SchoolPortalPage::get()->First()->Link('edit');
                return $this->controller->redirect( $schoolPage );
            } else if(Permission::check('EDIT_STUDENT')) {
                $studentPage = StudentPortalPage::get()->First()->Link('edit');
                return $this->controller->redirect( $studentPage );            
            } else {
                return false;
            }
        }

        return false;
    }
}