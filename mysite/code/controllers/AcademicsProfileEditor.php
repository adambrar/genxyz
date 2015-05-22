<?php
/**
 * Handles editing of partners' profiles.
 *
 * @package    silverstripe-memberprofiles
 * @subpackage controllers
 */
class AcademicsProfileEditor extends Page_Controller {

	private static $url_handlers = array(
		'university/$MemberID!' => 'handleUniversityEdit',
        'agent/$MemberID!' => 'handleAgentEdit'
	);

	private static $allowed_actions = array(
		'handleUniversityEdit',
        'handleAgentEdit'
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
    public function handleAgentEdit($request) {
        $id = $request->param('MemberID');

        if(!$id) {
            $this->httpError(404);
        }

		if(!ctype_digit($id)) {
			$this->httpError(404);
		}

		$member = Member::get()->byID($id);
        
		if(!$member || $member->MemberType != "Agent" || Member::currentUserID() != $id) {
			$this->httpError(404);
		}

        $profileContent = PartnersProfile::get()->byID($member->PartnersProfileID);

		$this->data()->Title = sprintf(
			_t('MemberProfiles.MEMBERPROFILETITLE', "%s's Information"),
			$member->getName()
		);
		$this->data()->Parent = $this->parent;
        
        $customData = array(
            'Member' => $member,
            'IsSelf' => $member->ID == Member::currentUserID(),
            'menuShown' => 'None',
            'BasicInfo' => $this->parent->BasicInfoForm()->loadDataFrom($member),
            'ProfileContent' => $this->parent->ProfileContentForm($id)->loadDataFrom($profileContent),
            'Logo' => $profileContent->LogoImageID ? File::get()->ByID($profileContent->LogoImageID) : false            
        );
        
        $controller = $this->customise($customData);
		return $controller->renderWith(array(
			'AgentProfile_edit', 'Page'
		));
	} 

	/**
	 * Handles viewing a university's profile.
	 *
	 * @return string
	 */
	public function handleUniversityEdit($request) {
		$id = $request->param('MemberID');

        if(!$id) {
            $this->httpError(404);
        }

		if(!ctype_digit($id)) {
			$this->httpError(404);
		}

		$member = Member::get()->byID($id);
        
		if(!$member || $member->MemberType != "University" || Member::currentUserID() != $id) {
			$this->httpError(404);
		}

		$this->data()->Title = sprintf(
			_t('MemberProfiles.MEMBERPROFILETITLE', "%s's Profile"),
			$member->getName()
		);
		$this->data()->Parent = $this->parent;
        
        $profileContent = PartnersProfile::get()->byID($member->PartnersProfileID);
        
        $customData = array(
            'Member' => $member,
            'IsSelf' => $member->ID == Member::currentUserID(),
            'menuShown' => 'None',
            'BasicInfo' => $this->parent->BasicInfoForm()->loadDataFrom($member),
            'ProfileContent' => $this->parent->ProfileContentForm($id)->loadDataFrom($profileContent),
            'ProfileLinks' => $this->parent->ProfileLinksForm($id)->loadDataFrom($profileContent),
            'Logo' => $profileContent->LogoImageID ? File::get()->ByID($profileContent->LogoImageID) : false
        );
        
        $controller = $this->customise($customData);
		return $controller->renderWith(array(
			'UniversityProfile_edit', 'Page'
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