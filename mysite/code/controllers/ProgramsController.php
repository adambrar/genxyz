<?php

/**
 * Class to handle messaging forms and urls
 **/

class ProgramsController extends Controller {
    private static $allowed_actions = array(
        'ajaxProgramDetails'        
    );
    
    public function ajaxProgramDetails($message = "", $extraData = null, $status = 'success') {
        $this->response->addHeader('Content-Type', 'application/json');
        
        if($status != 'success') {
            return $this->setStatusCode(400, $message);
        }
        
        $id = $this->getRequest()->param('ID');       
        if($id == null) {
            return $this->renderWith('AjaxError', ['ErrorMessage', 'Parameter missing']);
        }
        
        
        
        if(!ctype_digit($id)) {
            return $this->renderWith('AjaxError', ['ErrorMessage' => 'Problem with parameter format.']);
        }
        
        $program = Program::get()->ByID($id);
        
        if(!$program ) {
            return $this->renderWith('AjaxError', ['ErrorMessage' => 'Program not found.']);
        }

        return $this->renderWith('ProgramDetails', ['Program' => $program]);
    }
}