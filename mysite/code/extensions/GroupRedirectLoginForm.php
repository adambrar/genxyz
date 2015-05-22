<?php
class GroupRedirectLoginForm extends MemberLoginForm {
    
    private static $allowed_actions = array(
        'dologin'
    );
    
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
    
    public function redirectByGroup($data) 
    {   
        // gets the current member that is logging in
        $member = Member::currentUser();
         
        // gets all the groups.
        $Groups = DataObject::get("Group");
         
        //cycle through each group  
        foreach($Groups as $Group)
        {
            //if the member is in the group and that group has GoToAdmin checked or GoToAcademicsPortal
            if( $member && $member->inGroup($Group->ID) && ($Group->GoToAdmin == 1 || $Group->GoToAcademicsPortal == 1) ) 
            {   
                //redirect to the admin page
                if($Group->GoToAdmin)
                    return $this->controller->redirect( Director::baseURL() . 'admin' );
                else
                    $portalPage = AcademicsPortalPage::get()->First()->Link();
                    return $this->controller->redirect( $portalPage );
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