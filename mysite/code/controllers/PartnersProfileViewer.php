<?php
/**
 * Handles displaying member's public profiles.
 *
 * @package    silverstripe-memberprofiles
 * @subpackage controllers
 */
class PartnersProfileViewer extends Page_Controller {

	private static $url_handlers = array(
		'school/$MemberID!' => 'handleSchoolView',
        'agent/$MemberID!' => 'handleAgentView'
	);

	private static $allowed_actions = array(
		'handleSchoolView',
        'handleAgentView'
	);

	protected $parent;

	/**
	 * @param RequestHandler $parent
	 * @param string $name
	 */
	public function __construct($parent) {
		$this->parent = $parent;
        
        parent::__construct();
	}
    
    /**
	 * Handles viewing a university's profile.
	 *
	 * @return string
	 */
    public function handleAgentView($request) {
        if(!Permission::check('VIEW_AGENT')) {
            return Security::permissionFailure();
        }
        
        $id = $request->param('MemberID');

        if(!$id) {
            $this->httpError(404);
        }

		if(!ctype_digit($id)) {
			$this->httpError(404);
		}

		$member = Member::get()->byID($id);
		if(!$member) { $this->httpError(404); }
        
		$this->data()->Title = sprintf(
			_t('MemberProfiles.MEMBERPROFILETITLE', "%s's Information"),
			$member->Name
		);
		$this->data()->Parent = $this->parent;
        
        $customData = array(
            'Member' => $member,
            'IsSelf' => $member->ID == Member::currentUserID()
        );
        
        $controller = $this->customise($customData);
		return $controller->renderWith(array(
			'AgentProfile_view', 'Page'
		));
	}

	/**
	 * Handles viewing a university's profile.
	 *
	 * @return string
	 */
	public function handleSchoolView($request) {
        if(!Permission::check('VIEW_SCHOOL')) {
            return Security::permissionFailure();
        }
        
        $id = $request->param('MemberID');
        
        if(!$id) {
            $this->httpError(404);
        }

		if(!ctype_digit($id)) {
			$this->httpError(404);
		}

		$school = School::get()->byID($id);
        if(!$school) {$this->httpError(404);}
        
        $profilePage = PartnersProfile::get()->ByID($school->PartnersProfileID);
		if(!$profilePage) {
			$profilePage = new PartnersProfile();
            $school->ProfilePageID = $profilePage->write();
            $school->write();
		}

		$this->data()->Title = sprintf(
			_t('MemberProfiles.MEMBERPROFILETITLE', "%s's Profile"),
			$school->getName()
		);
		$this->data()->Parent = $this->parent;
        
        $customData = array(
            'Member' => $school,
            'IsSelf' => $school->ID == School::currentUserID(),
            'ProfilePage' => $profilePage,
            'Title' => $school->Name ? $school->Name."'s Profile Page" : 'Profile Page',
            'ApplicationForm' => ApplicationsController::create()->CreateSchoolApplicationForm($id),
            'SessionMessage' => $this->getSessionMessage(),
        );
        
        $controller = $this->customise($customData);
		return $controller->renderWith(array(
			'SchoolProfile_view', 'Page'
		));
	}
    
	/**
	 * @return string
	 */
	public function Link($action = null) {
		return Controller::join_links($this->parent->Link(), $this->name, $action);
	}

}