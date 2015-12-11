<?php

/**
 * Class to handle messaging forms and urls
 **/

class MessagingController extends Controller {
    private static $allowed_actions = array(
        'AddMessageForm',
        'AddMessageThreadForm',
        'addMessage',
        'addMessageThread',
        'ajaxMessageRequest'
    );
    
    public function AddMessageForm($ThreadID) {
        $fields = new FieldList(
            new TextAreaField('Content', 'Reply'),
            new HiddenField('ParentID', 'ParentID', $ThreadID)
        );
        
        $actions = FieldList::create(
            FormAction::create('addMessage', 'Send')->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'Content'
        ));
                                       
        return new Form($this, 'AddMessageForm', $fields, $actions, $required);
    }
    
    public function AddMessageThreadForm() {
        $fields = new FieldList(
            DropdownField::create('StudentID', 'Send to', Student::getStudentOptions())->setEmptyString('Select recipient from students'),
            new TextField('Title', 'Subject'),
            new TextAreaField('Content', 'Message')
        );
        
        $actions = FieldList::create(
            FormAction::create('addMessageThread', 'Send')->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'Content'
        ));
                                       
        return new Form($this, 'AddMessageThreadForm', $fields, $actions, $required);
    }
    
    public function addMessage(array $data, Form $form) {
        $messageThread = MessageThread::get()->byID($data['ParentID']);
        
        //TODO: better error handling
        if(!$messageThread || ($messageThread->AgentID != Agent::currentUserID() && $messageThread->StudentID != Student::currentUserID())) {
            Session::set('SessionMessage', 'You cannot send that message.');
            Session::set('SessionMessageContext', 'danger');
            return false;
        }
        
        $message = new Message();
        
        $form->saveInto($message);
        $message->Author = Member::currentUser()->ClassName;
        $message->write();
        
        Session::set('SessionMessage', 'Your has been sent.');
        Session::set('SessionMessageContext', 'success');
        $this->redirectBack();
    }
    
    public function addMessageThread(array $data, Form $form) {
        $agentID = Agent::currentUserID();
        
        //TODO: create message permission check
        if(!$agentID) {
            return false;
        }
        
        $messageThread = new MessageThread();
        $form->saveInto($messageThread);
        $messageThread->AgentID = $agentID;
        $threadID = $messageThread->write();
        
        $message = new Message();
        
        $form->saveInto($message);
        $message->Author = "Agent";
        $message->ParentID = $threadID;
        $message->write();
        $this->redirectBack();
    }
    
    public function ajaxMessageRequest($message = "", $extraData = null, $status = 'success') {
        $this->response->addHeader('Content-Type', 'application/json');
        
        if($status != 'success') {
            $this->setStatusCode(400, $message);
        }
                
        if(!isset($_POST['ThreadID']) && !isset($_GET['ThreadID'])) {
            return $this->renderWith('AjaxError', ['ErrorMessage', 'Parameter missing']);
        }
        
        $id = 0;
        if(isset($_POST['ThreadID'])) {
            $id = $_POST['ThreadID'];
        } else {
            $id = $_GET['ThreadID'];
        }
        
        if(!ctype_digit($id)) {
            return $this->renderWith('AjaxError', ['ErrorMessage' => 'Problem with parameter format.']);
        }
        
        if($id == 0) {
            return $this->renderWith('MessageThread', ['MessageThread' => false,
                                                       'AddMessageForm' => $this->AddMessageThreadForm()]);
        }
        
        $messageThread = MessageThread::get()->ByID($id);
        
        if( !$messageThread || 
           ( $messageThread->AgentID != Agent::currentUserID() && $messageThread->StudentID != Student::currentUserID() ) ) {
            return $this->renderWith('AjaxError', ['ErrorMessage' => 'Missing security permission.']);
        }

        return $this->renderWith('MessageThread', ['MessageThread' => $messageThread,
                                                  'AddMessageForm' => $this->AddMessageForm($messageThread->ID)]);
    }
}