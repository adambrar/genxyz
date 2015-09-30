<?php
/**
 * Handles displaying member's public profiles.
 *
 * @package    silverstripe-memberprofiles
 * @subpackage controllers
 */
class AcademicsProfileViewer extends Page_Controller {

	private static $url_handlers = array(
		'university/$MemberID!' => 'handleUniversityView',
        'agent/$MemberID!' => 'handleAgentView'
	);

	private static $allowed_actions = array(
		'handleUniversityView',
        'handleAgentView'
	);

	protected $parent, $name;

	/**
	 * @param RequestHandler $parent
	 * @param string $name
	 */
	public function __construct($parent, $name) {
		$this->parent = $parent;
		$this->name   = $name;

        parent::__construct();
	}
    
    /**
	 * Handles viewing a university's profile.
	 *
	 * @return string
	 */
    public function handleAgentView($request) {
        $id = $request->param('MemberID');

        if(!$id) {
            $this->httpError(404);
        }

		if(!ctype_digit($id)) {
			$this->httpError(404);
		}

		$member = Member::get()->byID($id);
        $profilePage = PartnersProfile::get()->ByID($member->PartnersProfileID);
        
		if(!$member || !$profilePage) {
			$this->httpError(404);
		}

		$this->data()->Title = sprintf(
			_t('MemberProfiles.MEMBERPROFILETITLE', "%s's Information"),
			$member->BusinessName
		);
		$this->data()->Parent = $this->parent;
        
        $customData = array(
            'Member' => $member,
            'IsSelf' => $member->ID == Member::currentUserID(),
            'ProfilePage' => $profilePage,
            'Logo' => $profilePage->LogoImageID ? File::get()->ByID($profilePage->LogoImageID) : false
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
	public function handleUniversityView($request) {
		$id = $request->param('MemberID');
        
        if(!$id) {
            $this->httpError(404);
        }

		if(!ctype_digit($id)) {
			$this->httpError(404);
		}

		$member = Member::get()->byID($id);
        if(!$member) {$this->httpError(404);}
        
        $profilePage = PartnersProfile::get()->ByID($member->PartnersProfileID);
		if(!$profilePage) {
			$this->httpError(404);
		}

		$this->data()->Title = sprintf(
			_t('MemberProfiles.MEMBERPROFILETITLE', "%s's Profile"),
			$member->getName()
		);
		$this->data()->Parent = $this->parent;
        
        $customData = array(
            'Member' => $member,
            'IsSelf' => $member->ID == Member::currentUserID(),
            'ProfilePage' => $profilePage,
            'Title' => $member->BusinessName ? $member->BusinessName."'s Profile Page" : 'Profile Page',
        );
        
        $controller = $this->customise($customData);
		return $controller->renderWith(array(
			'UniversityProfile_view', 'Page'
		));
	}
    
	/**
	 * @return int
	 */
	public function getPaginationStart() {
		if ($start = $this->request->getVar('start')) {
			if (ctype_digit($start) && (int) $start > 0) return (int) $start;
		}

		return 0;
	}

	/**
	 * @return string
	 */
	public function Link($action = null) {
		return Controller::join_links($this->parent->Link(), $this->name, $action);
	}

}