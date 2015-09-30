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
        
		if(!$member || !$member->isAgent() || Member::currentUserID() != $id) {
			return Security::permissionFailure(null, 'Sign into a partner profile to view this content.');
		}
        
        //check user has profile page and create if not
        if(!$member->PartnersProfileID) {
            $member->PartnersProfileID = $this->parent->createProfilePage();
            $member->write();
       }
        
        $profileContent = PartnersProfile::get()->byID($member->PartnersProfileID);
        
        $this->data()->Title = sprintf(
			_t('MemberProfiles.MEMBERPROFILETITLE', "%s's Information"),
			$member->BusinessName
		);
		$this->data()->Parent = $this->parent;
        
        $customData = array(
            'Member' => $member,
            'IsSelf' => $member->ID == Member::currentUserID(),
            'menuShown' => 'None',
            'BasicInfo' => $this->parent->BasicInfoForm()->loadDataFrom($member),
            'ProfileContent' => $this->parent->AgentProfileContentForm($id)->loadDataFrom($profileContent),
            'AddServices' => $this->parent->AddAcademicServiceForm(),
            'EditServices' => $this->parent->EditAcademicServiceForm(),
            'SchoolPartnersForm' => $this->parent->SchoolPartnersForm()
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
        
		if(!$member || !$member->isUniversity() || Member::currentUserID() != $id) {
			return Security::permissionFailure(null, 'Sign into a partner profile to view this content.');
		}

		$this->data()->Title = sprintf(
			_t('MemberProfiles.MEMBERPROFILETITLE', "%s's Profile"),
			$member->getName()
		);
		$this->data()->Parent = $this->parent;
        
        if(!$member->PartnersProfileID) {
            $member->PartnersProfileID = $this->parent->createProfilePage();
            $member->write();
        }
        
        $profileContent = PartnersProfile::get()->byID($member->PartnersProfileID);
        
        $customData = array(
            'Member' => $member,
            'IsSelf' => $member->ID == Member::currentUserID(),
            'menuShown' => 'None',
            'BasicInfo' => $this->parent->BasicInfoForm()->loadDataFrom($member),
            'ProfileContent' => $this->parent->InstitutionProfileContentForm($id)->loadDataFrom($profileContent),
            'ProfileLinks' => $this->parent->ProfileLinksForm($id)->loadDataFrom($profileContent),
            'AddAcademicProgramsForm' => $this->parent->AddAcademicProgramsForm($member)->loadDataFrom($member),
            'EditAcademicProgramsForm' => $this->parent->EditAcademicProgramsForm($member)->loadDataFrom($member),
            'Title' => $member->BusinessName ? $member->BusinessName."'s Profile Page" : 'Profile Page',
            'SchoolPartnersForm' => $this->parent->SchoolPartnersForm(),
            'AgentPartnersForm' => $this->parent->AgentPartnersForm()
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