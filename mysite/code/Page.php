<?php
class Page extends SiteTree implements PermissionProvider {

	private static $db = array(
        'menuWelcome' => 'Boolean',
        'menuStudent' => 'Boolean',
        'menuUniversity' => 'Boolean',
        'menuStudentSidebar' => 'Boolean',
        'menuShown' => "Enum('Welcome, Student, University, None')",
        'showDropdown' => 'Boolean(1)'
	);

	private static $has_one = array(
        
	);
    
    private static $defaults = array(
        'menuShown' => 'Student',
        'showDropdown' => '1'
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
    
    /*
     *  array of restricted pagetypes, only to be managed
     *  by users that have MANAGE_RESTRICTED_PAGETYPES permission
     */
    protected static $restricted_pagetypes = array();
 
    /*
     *  Add a new permission
     */
    function providePermissions(){
        return array(
            'MANAGE_RESTRICTED_PAGETYPES' => array(
                'name' => _t(
                    'Page.RESTRICTED_PAGETYPES',
                    'Manage restricted pagetypes'
                ),
                'category' => _t(
                    'Page.PERMISSIONS_SETTINGS',
                    'Special settings'
                ),
                'help' => _t(
                    'Page.RESTRICTED_PAGETYPES_HELP',
                    'Can create and delete restricted pagetypes'
                ),
                'sort' => 100
            ),
            'VIEW_PROFILES' => array(
                'name' => 'Can view profiles',
                'category' => 'User access',
                'help' => 'Can view all user profiles',
                'sort' => 101
            ),
            'POST_IN_FORUM' => array(
                'name' => 'Can post to forum',
                'category' => 'User access',
                'help' => 'Can make new posts in forum',
                'sort' => 103
            ),
        );
    }
    
    /*
     * setter for resticted pagetpes
     */
    public static function set_restricted_pagetypes($pagetypes) {
        self::$restricted_pagetypes = $pagetypes;
    }
    
    /*
     *  check if this is a restricted pagetype and if the user
     *  has permission to manage restricted pagetypes
     */
    protected function canManageRestrictedPagetypes($Member) {
 
        // are there any restricted pagetypes?
        if (!empty(self::$restricted_pagetypes)) {
            if (in_array($this->ClassName, self::$restricted_pagetypes)) {
 
                if (!Permission::check('MANAGE_RESTRICTED_PAGETYPES')) {
                    return false;
                }
            }
        }
        return true;
    }
    
    public function canViewProfiles($Member = null)
    {
        return false;   
        if(Permission::check('VIEW_PROFILES')) {
            return true;
        } else {
            return Securtiy::permissionFailure($this, 'You need to be logged in to view this profile. Please login or create an account.');
        }
    }
    
    /*
     *  disable the creation of restricted pages for people
     *  that don't have the right pernmissions
     */
    function canCreate($Member = null){
        if ($this->canManageRestrictedPagetypes($Member)) {
            return parent::canCreate($Member);
        } else {
            return false;
        }
    }
    
    /*
     *  disable the deletion of restricted pages for people
     *  that don't have the right pernmissions
     */
    function canDelete($Member = null){
        if ($this->canManageRestrictedPagetypes($Member)) {
            return parent::canDelete($Member);
        } else {
            return false;
        }
    }
    
    function isSignedIn() {
        if( Member::currentUserID() )
            return true;
        else
            return false;
    }
    
    function profilePageLink() {
        $profilePage = MemberProfilePage::get()->filter(array(
            'AllowRegistration' => '0',
            'AllowProfileEditing' => '1'
        ))->First();
        
        if($profilePage)
            return $profilePage->Link();
        else
            return false;
    }
    
    function UniversityName($id) {
        if(!$id) return false;
        
        $name = University::get()->byID($id);
        
        if($name)
            return $name->Title;
        else
            return false;
    }
    
    function HighSchoolName($id) {
        if(!$id) return false;
        
        $name = HighSchool::get()->byID($id);
        
        if($name)
            return $name->Title;
        else
            return false;
    }
    
    function CountryName($code) {
        if(!$code) return false;

        $name = Country::get()->filter('code', $code)->First()->Name;
        
        if($name)
            return $name;
        else
            return false;
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
        'countriesasjson',
        'citiesasjson'
    );
	
	public function init() {
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
        if($this->dataRecord->hasExtension('Translatable')) {
            i18n::set_locale($this->dataRecord->Locale);
        }
        
        Requirements::javascript('silverstripe/themes/' . SSViewer::current_theme() . '/javascript/selectload.js');
        
        self::logoutInactiveUser();
	}
    
    public function countriesasjson($message = "", $extraData = null, $status = "success") 
    {
        $this->response->addHeader('Content-Type', 'application/json');
        SSViewer::set_source_file_comments(false);
		if($status != "success") {
			$this->setStatusCode(400, $message);
		}
		// populate Javascript
		$js = array ();
        
        $countries = Country::get()->sort('Name', 'ASC');
        
        if($countries)
        {
            foreach($countries as $country)
            {
                $js[] = array(
                    "title" => $country->Name,
                    "value" => $country->ID
                );
            }
        }
        
        if(is_array($extraData)) { $js = array_merge($js, $extraData); }
        
        $json = json_encode($js);
        
        return $json;
    }
    
    public function citiesasjson($message = "", $extraData = null, $status = "success") 
    {
        $this->response->addHeader('Content-Type', 'application/json');
        SSViewer::set_source_file_comments(false);
		if($status != "success") {
			$this->setStatusCode(400, $message);
		}
		// populate Javascript
		$js = array ();
        
        $cities = City::get()->sort('Name', 'ASC');
        
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
        if ($elapsed_time >= $inactivityLimit) { 
          $member = Member::currentUser(); 
          if($member) {
            // Logout member
            $member->logOut();
          }
          // Clear session
          Session::clear_all();
          // Redirect user to the login screen
          $this->redirect(Director::baseURL() . 'Security/login'); 
        } 
      }

      // Set new value
      Session::set('session_start_time', time()); 
    }

}
