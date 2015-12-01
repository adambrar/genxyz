<?php

/**
 * Class to handle student application forms and requests
 **/

class ApplicationsController extends Controller {
    private static $allowed_actions = array(
        'getform',
        'SchoolApplicationDetails',
        'SchoolApplicationEdit',
        'saveSchoolApplication',
        'CreateSchoolApplicationForm',
        'createschoolapplication',
        'editschoolapplication'
    );
    
    private static $url_handlers = array(
        'getform/$FormName/$ApplicationID' => 'getform'
    );
    
    public function getform($message = "", $extraData = null, $status = 'success') {
        $this->response->addHeader('Content-Type', 'application/json');
        SSViewer::set_source_file_comments(false);
        
        if($status != 'success') {
            $this->setStatusCode(400, $message);
        }
        if(!$this->getRequest()->param('FormName') || !$this->getRequest()->param('ApplicationID')) {
            return $this->renderWith('AjaxError', ['ErrorMessage', 'Parameter missing.']);
        }
        
        if(!ctype_digit($this->getRequest()->param('ApplicationID'))) {
            return $this->renderWith('AjaxError', ['ErrorMessage' => 'Problem with parameter format.']);
        }
        
        $application = SchoolApplication::get()->byID($this->getRequest()->param('ApplicationID'));

        if(!$application) {
            return $this->renderWith('AjaxError', ['ErrorMessage' => 'Application not found.']);
        }
        $member = Member::currentUserID();
        
        //if not member of if member is not agent or student on application
        if( (!$member) ||
            (($member != $application->StudentID)&&($member != $application->AgentID)) ) {
                return $this->renderWith('AjaxError', ['ErrorMessage' => 'You cannot access this application.']);
        }
            
        if($this->getRequest()->param('FormName') == 'SchoolApplicationDetails') {

            return $this->SchoolApplicationDetails()->loadDataFrom($application)->forTemplate();
            
        } else if($this->getRequest()->param('FormName') == 'SchoolApplicationEdit') {

            return $this->SchoolApplicationEdit()->loadDataFrom($application)->forTemplate();
            
        } else if($this->getRequest()->param('FormName') == 'SchoolApplicationFiles') {

            $html = '<ul class="list-unstyled">';

            if($application->StudentFiles()->Count() > 0) {
                foreach($application->StudentFiles() as $file) {
                    $html .= '<li><strong>'.$file->Title.':</strong><div class="btn-group btn-group-justified" role="group"><a target="_blank" href="'.$file->Link().'" class="btn btn-primary btn-md">View</a><a href="'.$file->Link().'" class="btn btn-primary btn-md">Download <small>45MB</small></a></div></li>';
                }
            } else {
                $html .= '<li class="text-center"><strong>No files attached to this application!</strong></li>';
            }

            $html .= '</ul>';

            return $html;
        } else if($this->getRequest()->param('FormName') == 'SchoolApplicationEdit') {

            return $this->SchoolApplicationEditForm($application->SchoolID)->loadDataFrom($application)->forTemplate();
        } else {
            return $this->renderWith('AjaxError', ['ErrorMessage' => 'Form not found.']);
        }
    }
    
    public function SchoolApplicationDetails() {
        $fields = new FieldList(
            new TextAreaField('Notes', 'Notes'),
            new DropdownField('Status', 'Status', array('Completed','Processing','Incomplete')),
            new HiddenField('ID','ID')
        );
        
        $actions = FieldList::create(
            FormAction::create('Close', 'Close')->addExtraClass('btn btn-default')->setAttribute('data-dismiss','modal'),
            FormAction::create('saveSchoolApplication', 'Save Application')->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'Status'
        ));
                                       
        return new Form($this, 'SchoolApplicationDetails', $fields, $actions, $required);
    }
    
    public function SchoolApplicationEdit($schoolID = 0) {
        $fields = new FieldList(
            new TextAreaField('Notes', 'Notes'),
            $uploadField = new UploadField($name = 'StudentFiles', $title = 'Upload the required files.'),
            new HiddenField('ID','ID')
        );
        $uploadField->setFolderName('students/'.Student::currentUserID().'/applications/'.$schoolID);
        $uploadField->setAllowedFileCategories(array('image','doc'));
        $uploadField->setCanAttachExisting(false);
        $uploadField->setCanPreviewFolder(false);
        
        $actions = FieldList::create(
            FormAction::create('Close', 'Close')->addExtraClass('btn btn-default')->setAttribute('data-dismiss','modal'),
            FormAction::create('saveSchoolApplication', 'Save Application')->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'Status'
        ));
                                       
        return new Form($this, 'SchoolApplicationEdit', $fields, $actions, $required);
    }
    
    public function saveSchoolApplication(array $data, Form $form) {
        if(!ctype_digit($data['ID'])) {
            Session::set('SessionMessage', 'There was an error saving your application. Reload the page and try again.');
            Session::set('SessionMessageContext', 'error');
        }
        $application = SchoolApplication::get()->byID($data['ID']);
        
        if(!$application) {
            Session::set('SessionMessage', 'Application not found!');
            Session::set('SessionMessageContext', 'warning');
        }
        
        $form->saveInto($application);        
        $application->write();
        Session::set('SessionMessage', 'Your application has been updated and saved.');
        Session::set('SessionMessageContext', 'success');
        
        return $this->redirectBack();
    }
     
    public function CreateSchoolApplicationForm($schoolID = 0) {
        $fields = new FieldList(
            new LiteralField('Description', '<h5>Fill out your application to apply for this school. <small>You need to have an account to apply.</small></h5>'),
            $uploadField = new UploadField($name = 'StudentFiles', $title = 'Upload the required files.'),
            new HiddenField('SchoolID','SchoolID', $schoolID)
        );
        $uploadField->setFolderName('students/'.Student::currentUserID().'/applications/'.$schoolID);
        $uploadField->setAllowedFileCategories(array('image','doc'));
        $uploadField->setCanAttachExisting(false);
        $uploadField->setCanPreviewFolder(false);

        $actions = FieldList::create(
            FormAction::create('createapplication', 'Apply!')->addExtraClass('btn btn-primary btn-large')
        );
        
        $required = new RequiredFields(array(
            'Application'
        ));
        
        return new Form($this, 'CreateSchoolApplicationForm', $fields, $actions, $required);
    }
    
    public function createapplication(array $data, Form $form) {
        $application = SchoolApplication::get()->filter(array(
            'StudentID' => Student::currentUserID(),
            'SchoolID' => $data['SchoolID']
        ))->First();
        if($application) {
            Session::set('SessionMessage', 'You have already applied to this school!');
            Session::set('SessionMessageContext', 'warning');
            return $this->redirectBack();
        }
        
        $newApplication = new SchoolApplication();
        
        $form->saveInto($newApplication);
        $newApplication->StudentID = Student::currentUserID();
        $newApplication->Status = 'Processing';
        
        $newApplication->write();
        
        Session::set('SessionMessage', 'Your application has been started! You can view and edit your application in your profile.');
        Session::set('SessionMessageContext', 'success');

        return $this->redirectBack();
    }
}