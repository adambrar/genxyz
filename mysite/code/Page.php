<?php
class Page extends SiteTree implements PermissionProvider {

	private static $db = array(
        'menuWelcome' => 'Boolean',
        'menuStudent' => 'Boolean',
        'menuUniversity' => 'Boolean',
        'menuStudentSidebar' => 'Boolean',
        'menuShown' => "Enum('Welcome, Student, University, None')",
        'showDropdown' => 'Boolean(1)',
        'EnableZopim' => 'Boolean'
	);

	private static $has_one = array(
        
	);
    
    private static $defaults = array(
        'menuShown' => 'Student',
        'showDropdown' => '1',
        'EnableZopim' => false
    );
    
    function getSettingsFields() {
        $fields = parent::getSettingsFields();
        
        $fields->addFieldToTab('Root.Settings', new CheckboxField('menuWelcome',"Show up in welcome menu?"), 'ShowInSearch');
        $fields->addFieldToTab('Root.Settings', new CheckboxField('menuStudent',"Show up in student menu?"), 'ShowInSearch');
        $fields->addFieldToTab('Root.Settings', new CheckboxField('menuUniversity',"Show up in university menu?"), 'ShowInSearch');
        $fields->addFieldToTab('Root.Settings', new CheckboxField('menuStudentSidebar',"Show up in student sidebar menu?"), 'ShowInSearch');
        $fields->addFieldToTab('Root.Settings', new CheckboxField('showDropdown',"Show dropdown menu for children?"), 'ShowInSearch');
        
        $options = array('Welcome', 'Student', 'University');
        $menuOptions = DropdownField::create( 'menuShown', 'Which menu will show on this page?', singleton('Page')->dbObject('menuShown')->enumValues() )->setEmptyString('Select menu');
        $fields->addFieldToTab('Root.Settings', $menuOptions, 'ShowInSearch');
        
        return $fields;
    }
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab("Root.Zopim", new CheckboxField('EnableZopim', 'Enable Zopim Chat on the page?'));
        
        //$fields->removeByName("Content");

        return $fields;
    }
    
    public function providePermissions() {
        return array(
            'VIEW_STUDENT' => 'Can view student content',
            'EDIT_STUDENT' => 'Can edit student content',
            'VIEW_AGENT' => 'Can view agent content',
            'EDIT_AGENT' => 'Can edit agent content',
            'VIEW_SCHOOL' => 'Can view school content',
            'EDIT_SCHOOL' => 'Can edit school content'
        );
    }
    
    function URLSafeTitle() {
        return strtolower(preg_replace('/[^A-Za-z0-9]/', '', $this->Title));
    }
    
    public function getIncludeTemplate() {
        return $this->renderWith(array($this->ClassName,'DefaultStudentContent','Page'));
    }
}

class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
    
    private static $allowed_actions = array(
        'logout',
        'citiesasjson'
    );
	
	public function init() {
        Requirements::set_force_js_to_bottom(true);
        
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
        if($this->dataRecord->hasExtension('Translatable')) {
            i18n::set_locale($this->dataRecord->Locale);
        }
        Requirements::javascript('themes/one/javascript/jquery.js');
        Requirements::javascript('themes/one/javascript/bootstrap.min.js');
        Requirements::javascript('themes/one/javascript/owl.carousel.min.js');
        Requirements::javascript('themes/one/javascript/mousescroll.js');
        Requirements::javascript('themes/one/javascript/smoothscroll.js');
        Requirements::javascript('themes/one/javascript/jquery.prettyPhoto.js');
        Requirements::javascript('themes/one/javascript/jquery.inview.min.js');
        Requirements::javascript('themes/one/javascript/wow.min.js');
        Requirements::javascript('themes/one/javascript/matchheight.min.js');
        Requirements::javascript('themes/one/javascript/main.js');
        Requirements::javascript(
            FRAMEWORK_DIR."/admin/thirdparty/chosen/chosen/chosen.jquery.js");
        Requirements::css(
            FRAMEWORK_DIR."/admin/thirdparty/chosen/chosen/chosen.css");
        
        Requirements::block(FRAMEWORK_DIR.
                            "/thirdparty/jquery/jquery.js");
        Requirements::block(FRAMEWORK_DIR.
                            "/thirdparty/jquery/jquery.min.js");
	}
    
    public function logout() {
        if(Controller::curr() == "StudentPortalPage_Controller" ||
           Controller::curr() == "SchoolPortalPage_Controller" ||
           Controller::curr() == "AgentPortalPage_Controller") {
            Member::currentUser()->logout();
            return $this->redirectBack();
        } else {
            return $this->redirect('Security/login');
        }
    }
    
    public function citiesasjson($message = "", $extraData = null, $status = "success") {
        $this->response->addHeader('Content-Type', 'application/json');
        SSViewer::set_source_file_comments(false);
		if($status != "success") {
			$this->setStatusCode(400, $message);
		}
		// populate Javascript
		$js = array ();
        
        if(!(isset($_GET['Country'])) || $_GET['Country'] == "") {
            return json_encode(array(
                "title" => "Select a country below to load cities",
                "value" => "false"
            ));
        }
        
        if(!(ctype_digit($_GET['Country']))) {
            return json_encode(array(
                "title" => "Select a valid country below to load cities",
                "value" => "error"
            ));
        }
        
        $country = Country::get()->ByID($_GET['Country']);
        
        $cities = City::get()->filter('CountryCode', $country->Code)->sort('Name', 'ASC');
        
        if($cities)
        {
            foreach($cities as $city)
            {
                $js[] = array(
                    "title" => $city->Name,
                    "value" => $city->ID
                );
            }
        }
        
        if(is_array($extraData)) { $js = array_merge($js, $extraData); }
        
        $json = json_encode($js);
        
        return $json;
    }
    
    /**
    * The function will logout a user after certain amount of time
    *
    */
    function logoutInactiveUser() {
        // Set inactivity to half an hour (converted to seconds)
        $inactivityLimit = 30 * 60;

        // Get value from session
        $sessionStart = Session::get('session_start_time'); 
        if (isset($sessionStart)) {
            $elapsed_time = time() - Session::get('session_start_time');
            // If elapsed time is greater or equal to inactivity period, logout user
            if ($elapsed_time >= $inactivityLimit && Member::currentUserID()) { 
                $member = Member::currentUser(); 
                if($member) {
                    // Logout member
                    $member->logOut();
                }
                
                // Clear session
                Session::clear_all();
                // Redirect user to the login screen
                if(!$this->menuWelcome) {
                    $this->redirect(Director::baseURL() . 'Security/login');
                }
            }
        }

        // Set new value if user is logged in and on secure page
        if(Member::currentUserID()) {
            Session::set('session_start_time', time());
        }
    }
    
    public function getSessionMessage() {
        if(Session::get('SessionMessage')) {
            $message = array();
            $message['Content'] = Session::get('SessionMessage');
            Session::clear('SessionMessage');
            $message['Context'] = Session::get('SessionMessageContext') ? Session::get('SessionMessageContext') : 'primary';
            Session::clear('SessionMessageContext');
            return $message;
        }
        return false;
    }
    
    function getFooterScholarships() {
        return Scholarship::get()->limit(5);
    }

}
