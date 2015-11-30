<?php
/**
 * Handles displaying search page results
 *
 * 
 */
class SearchPageResults extends Page_Controller {

	private static $allowed_actions = array(
		'handleSearch',
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
	 * Handles search request
	 *
	 * @return array of custom data
	 */
	public function handleSearch($request) {
        $filter = array();
        $exclude = array();
        
        switch($this->searchType) {
            case 'agents':
                $filter = $this->agentFilter($request);
                break;
            case 'schools':
                $filter = $this->schoolFilter($request);
                break;
            case 'accomodations':
                $filter = $this->accomodationFilter($request);
                break;
            case 'mentors':
                $filter = $this->accomodationFilter($request);
                break;
            default:
                $this->httpError(404);
                break;               
        }
        
        $list = Member::get()->filter($filter)->exclude($exclude);
        $paginated = new PaginatedList($list, Controller::curr()->request);

        return array(
            'Title' => 'HandleSearch',
            'PaginatedResults' => $paginated->setPageLength(1),
            'Parameters' => $request->params(),
            'SearchType' => $this->searchType
        );        
	}
    
    private function agentFilter($request) {
        $filter = array();
        $filter['MemberType'] = 'Agent';
        if(isset($_GET['Country']) && strlen($_GET['Country']) > 0) {
            $filter['Country'] = base64_decode($_GET['Country']);
        }
        if(isset($_GET['City']) && strlen($_GET['City']) > 0) {
            $filter['City'] = base64_decode($_GET['City']);
        }
        if(isset($_GET['Service']) && strlen($_GET['Service']) > 0) {
            $filter['Services'] = base64_decode($_GET['Service']);
        }
        
        return $filter;
    }
    
    private function schoolFilter($request) {
        $filter = array();
        $filter['MemberType'] = 'University';
        
        return $filter;
    }
    
    private function accomodationFilter($request) {
        $filter = array();
        $filter['MemberType'] = 'Agent';
        
        return $filter;
    }
    
    private function mentorFilter($request) {
        $filter = array();
        $filter['MemberType'] = 'Student';
        
        return $filter;
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