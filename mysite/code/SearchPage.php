<?php 
 
class SearchPage extends Page 
{
    private static $db = array(
         'Updates' => 'HTMLText',
         'RecentlyAdded' => 'HTMLText',
     );
    
    private static $defaults = array(
        'menuShown' => 'Student',
        'menuWelcome' => false,
        'menuStudent' => true
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
              
        $fields->addFieldToTab("Root.Main", new HTMLEditorField('Updates', 'Updates'));      
        $fields->addFieldToTab("Root.Main", new HTMLEditorField('RecentlyAdded', 'Recently Added'));
        
        $fields->removeByName("Content");

        return $fields;
    }
    
    private $search;
}
 
class SearchPage_Controller extends Page_Controller 
{
    private static $allowed_actions = array(
        'FilterAcademics',
        'FilterAccomodations',
        'FilterAgents',
        'FilterMentors',
        'search',
        'show',
        'searchprogramsasjson',
        'searchcountriesasjson',
        'doAcademicsSearch',
        'doAccomodationsSearch',
        'doAgentsSearch',
        'doMentorsSearch',
        'getResults',
    );
    
    function init() {
        Requirements::set_force_js_to_bottom(true);
        Requirements::javascript('themes/one/javascript/searchpage.js');
        Requirements::javascript('themes/one/javascript/jquery.bootpag.min.js');
        Requirements::javascript(
            FRAMEWORK_DIR."/admin/thirdparty/chosen/chosen/chosen.jquery.js");
        Requirements::css(
            FRAMEWORK_DIR."/admin/thirdparty/chosen/chosen/chosen.css");
        $search = new SearchPageResults($this, 'get');
        
        parent::init();
    }
    
    public function show() {
        return new PartnersProfileViewer($this);
    }
    
    public function getResults($request) {
        $search = new SearchPageResults($this, 'get');
        $customData = $search->handleSearch($request);
        $controller = $this->customise($customData);
        
        if(Director::is_ajax()) {
            return $controller->renderWith('SearchPageResults', 'Page');
        }
        
        return $controller->renderWith(array('SearchPage', 'Page'));
    }
    
    public function FilterAcademics() {
        $fields = new FieldList(
            DropdownField::create('Country', _t(
                'AcademicsSearchForm.COUNTRY',
                'Country'))->setEmptyString('Select a country')->addExtraClass('filter-by-country chosen'),
            DropdownField::create('City', _t(
                'AcademicsSearchForm.COUNTRY',
                'City'))->setEmptyString('Select a city')->addExtraClass('filter-by-city chosen'),
            DropdownField::create('Program', _t(
                'AcademicsSearchForm.DEFAULT',
                'Program'), Program::getProgramOptions())->setEmptyString('Select Program')->addExtraClass('filter-by-program chosen'),
            DropdownField::create('StartDate', _t(
                'AcademicsSearchForm.COUNTRY',
                'Start Date'), array('May', 'September', 'January'))->setEmptyString('Select a starting month')->addExtraClass('chosen'),
            TextField::create('SchoolName', 'Name of Institution'),
            DropdownField::create('Level', 'Level of Study', array('Certificate','Diploma','Associate Degree', 'Degree', 'Post-Degree Certificate', 'Post-Degree Diploma', 'Masters', 'Doctorate'))->addExtraClass('chosen')
        );
        
        $actions = FieldList::create(
            FormAction::create('doAcademicsSearch', _t(
                'MemberProfileForms.DEFAULT',
                'Filter'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'FirstName',
            'Surname',
            'Email'
        ));
        
        return new Form($this->owner, 'FilterAcademics', $fields, $actions, $required);
    }
    
    public function doAcademicsSearch(array $data, Form $form) {
        if($data['Country'] == '' && $data['Program'] == '' && $data['StartDate'] == '' && $data['SchoolName'] == '') {
            $form->addErrorMessage('Blurb', 'Select filters to search!', 'bad');
            return $this->owner->redirect($this->Link( 'get/schools' ));
        }
        
        return $this->owner->redirect(
            $this->Link( 'get/school?Country=' . base64_encode( Convert::raw2sql($data['Country']) )
                            .'&Program=' . base64_encode( Convert::raw2sql($data['Program'])) )
                            .'&SchoolName=' . base64_encode( Convert::raw2sql($data['SchoolName']) )
                            .'&Level=' . base64_encode( Convert::raw2sql($data['Level']) ) );
    }
    
    public function FilterAccomodations() {
        $fields = new FieldList(
            DropdownField::create('Country', _t(
                'AcademicsSearchForm.COUNTRY',
                'Country'))->setEmptyString('Select a country')->addExtraClass('filter-by-country chosen'),
            DropdownField::create('City', _t(
                'AcademicsSearchForm.COUNTRY',
                'City'))->setEmptyString('Select a city')->addExtraClass('filter-by-city chosen'),
            DropdownField::create('Type', _t(
                'AcademicsSearchForm.DEFAULT',
                'Type'), array('Homestay', 'Hotel', 'Apartment', 'Room Share', 'Roommate', 'Sublet'))->setEmptyString('Select Accomodation Type')->addExtraClass('chosen')
        );
        
        $actions = FieldList::create(
            FormAction::create('doAccomodationsSearch', _t(
                'MemberProfileForms.DEFAULT',
                'Filter'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'FirstName',
            'Surname',
            'Email'
        ));
        
        return new Form($this->owner, 'FilterAccomodations', $fields, $actions, $required);
    }
    
    
    public function doAccomodationsSearch(array $data, Form $form) {
        if($data['Country'] == '' && $data['City'] == '' && $data['Type'] == '') {
            $form->addErrorMessage('Blurb', 'Select filters to search!', 'bad');
            return $this->owner->redirect($this->Link( 'get/accomodations' ));
        }
        
        return $this->owner->redirect(
            $this->Link( 'get/accomodations?Country=' . base64_encode( Convert::raw2sql($data['Country']) )
                            .'&City=' . base64_encode( Convert::raw2sql($data['City'])) )
                            .'&Type=' . base64_encode( Convert::raw2sql($data['Type']) ) );
    }
    
    public function FilterAgents() {
        $fields = new FieldList(
            DropdownField::create('Country', _t(
                'AcademicsSearchForm.COUNTRY',
                'Country'))->setEmptyString('Select a country')->addExtraClass('filter-by-country chosen'),
            DropdownField::create('City', _t(
                'AcademicsSearchForm.COUNTRY',
                'City'))->setEmptyString('Select a city')->addExtraClass('filter-by-city chosen'),
            DropdownField::create('Service', 'Service Requested', Service::getServiceOptions())->addExtraClass('chosen')
        );
        
        $actions = FieldList::create(
            FormAction::create('doAgentsSearch', _t(
                'MemberProfileForms.DEFAULT',
                'Filter'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'FirstName',
            'Surname',
            'Email'
        ));
        
        return new Form($this->owner, 'FilterAgents', $fields, $actions, $required);
    }
    
    public function doAgentsSearch(array $data, Form $form) {
        if($data['Country'] == '' && $data['City'] == '' && $data['Service'] == '') {
            $form->addErrorMessage('Blurb', 'Select filters to search!', 'bad');
            return $this->owner->redirect($this->Link( 'get/agents' ));
        }
        
        return $this->owner->redirect(
            $this->Link( 'get/agents?Country=' . base64_encode( Convert::raw2sql($data['Country']) )
                            .'&City=' . base64_encode( Convert::raw2sql($data['City'])) )
                            .'&Service=' . base64_encode( Convert::raw2sql($data['Type']) ) );
    }
    
    public function FilterMentors() {
        $fields = new FieldList(
            DropdownField::create('Country', _t(
                'AcademicsSearchForm.COUNTRY',
                'Country'))->setEmptyString('Select a country')->addExtraClass('filter-by-country chosen'),
            DropdownField::create('City', _t(
                'AcademicsSearchForm.COUNTRY',
                'City'))->setEmptyString('Select a city')->addExtraClass('filter-by-city chosen'),
            DropdownField::create('Request', _t(
                'AcademicsSearchForm.COUNTRY',
                'Request Type'), array('City Orientation', 'Academic Orientation', 'Events', 'Workshops', 'Tutoring'))->setEmptyString('What do you need?')->addExtraClass('chosen')
        );
        
        $actions = FieldList::create(
            FormAction::create('doMentorsSearch', _t(
                'MemberProfileForms.DEFAULT',
                'Filter'))->addExtraClass('btn btn-primary')
        );
        
        $required = new RequiredFields(array(
            'FirstName',
            'Surname',
            'Email'
        ));
        
        return new Form($this->owner, 'FilterMentors', $fields, $actions, $required);
    }
    
    public function doMentorsSearch(array $data, Form $form) {
        if($data['Country'] == '' && $data['City'] == '' && $data['Request'] == '') {
            $form->addErrorMessage('Blurb', 'Select filters to search!', 'bad');
            return $this->owner->redirect($this->Link( 'get/mentors' ));
        }
        
        return $this->owner->redirect(
            $this->Link( 'get/mentors?Country=' . base64_encode( Convert::raw2sql($data['Country']) )
                            .'&City=' . base64_encode( Convert::raw2sql($data['City'])) )
                            .'&Request=' . base64_encode( Convert::raw2sql($data['Request']) ) );
    }
    
    public function searchcountriesasjson($message = "", $extraData = null, $status = "success") {
        $this->response->addHeader('Content-Type', 'application/json');
        SSViewer::set_source_file_comments(false);
		if($status != "success") {
			$this->setStatusCode(400, $message);
		}
		// populate Javascript
		$js = array();
        
//        $countries = Country::get()->filter(array(
//            'ID' => 'Members.BusinessCountryID'
//        ))->sort('Name', 'ASC');
        $countries = Country::get();
        
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
}