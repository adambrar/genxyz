<?php 
 
class StudentProfileViewer extends MemberProfileViewer {
    
    /**
	 * Handles viewing an individual user's profile.
	 *
	 * @return string
	 */
	public function handleView($request) {
		$id = $request->param('MemberID');

		if(!ctype_digit($id)) {
			$this->httpError(404);
		}
        Member::get_by_id($id);
		$member = Member::get()->byID($id);
		$groups = $this->parent->Groups();

//		if(!$member->inGroups($groups)) {
//			$this->httpError(403);
//		}

		$sections     = $this->parent->Sections();
		$sectionsList = new ArrayList();

		foreach($sections as $section) {
			$sectionsList->push($section);
			$section->setMember($member);
		}

		$this->data()->Title = sprintf(
			_t('MemberProfiles.MEMBERPROFILETITLE', "%s's Profile"),
			$member->getName()
		);
		$this->data()->Parent = $this->parent;

		$controller = $this->customise(array(
			'Member'   => $member,
			'Sections' => $sectionsList,
			'IsSelf'   => $member->ID == Member::currentUserID()
		));
		return $controller->renderWith(array(
			'MemberProfileViewer_view', 'MemberProfileViewer', 'Page'
		));
	}
}