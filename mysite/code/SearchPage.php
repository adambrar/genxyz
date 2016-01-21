<?php 
 
class SearchPage extends Page 
{
    private static $db = array(
         'Updates' => 'HTMLText',
         'RecentlyAdded' => 'HTMLText',
    );
    
    
    private static $has_one = array(
        'BackgroundImage' => 'Image'
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $backgroundImage = new UploadField('BackgroundImage', 'Upload a background image.');
        $backgroundImage->setAllowedFileCategories('image');
        $backgroundImage->setAllowedMaxFileNumber(1);
        $backgroundImage->setFolderName('Uploads/defaults');
        $fields->addFieldToTab("Root.Main", $backgroundImage); 
        
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
        'FilterSchools',
        'FilterAccomodations',
        'FilterAgents',
        'FilterMentors',
        'show',
        'doSchoolSearch',
        'doAccomodationsSearch',
        'doAgentsSearch',
        'doMentorsSearch',
        'getFilter'
    );
    
    private static $url_handlers = array(
        'get/$SearchType!' => 'get'
    );
    
    private $coutryOptions;
    
    public function __construct() {
        parent::__construct();
        $this->countryOptions = Country::getCountryOptions();
    }
    
    function init() {
        parent::init();
        Requirements::javascript(
            FRAMEWORK_DIR."/admin/thirdparty/chosen/chosen/chosen.jquery.js");
        Requirements::css(
            FRAMEWORK_DIR."/admin/thirdparty/chosen/chosen/chosen.css");
        $this->data()->Title = 'Search Page';
    }
    
    public function show() {
        return new PartnersProfileViewer($this);
    }
    
    public function FilterSchools() {
        $schoolName = Controller::curr()->getRequest()->param('SchoolName');
        if($schoolName == '0') { $schoolName = ''; }
        
        $fields = new FieldList(
            DropdownField::create('Country', 'Country', $this->countryOptions, Controller::curr()->getRequest()->param('Country'))->setEmptyString('Select a country')->addExtraClass('filter-by-country chosen-select'),
            DropdownField::create('Program', 'Program', Program::getProgramOptions(), Controller::curr()->getRequest()->param('Program'))->setEmptyString('Select Program')->addExtraClass('chosen-select'),
            TextField::create('SchoolName', 'Name of School', $schoolName),
            DropdownField::create('Level', 'Level of Study', singleton('School')->dbObject('Type')->enumValues(), Controller::curr()->getRequest()->param('Level'))->setEmptyString('Type of School')->addExtraClass('chosen-select')
        );
        
        $actions = FieldList::create(
            FormAction::create('doSchoolSearch', 'Search')->addExtraClass('btn btn-primary'),
            new LiteralField('ClearFields', '<a href="'.SchoolPortalPage::get()->First()->Link('search').'" class="btn btn-default">Clear Fields</a>')
        );
        
        $required = new RequiredFields(array(
            'FirstName',
            'Surname',
            'Email'
        ));
        
        return new Form($this->owner, 'FilterSchools', $fields, $actions, $required);
    }
    
    public function doSchoolSearch(array $data, Form $form) {
        $URL = 'search/';
        
        $URL .= $data['Country'] == '' ? '0/' : $data['Country'].'/'; 
        $URL .= $data['Program'] == '' ? '0/' : $data['Program'].'/'; 
        $URL .= $data['SchoolName'] == '' ? '0/' : $data['SchoolName'].'/'; 
        $URL .= $data['Level'] == '' ? '0/' : $data['Level'].'/'; 
        
        
        return $this->owner->redirect( SchoolPortalPage::get()->First()->Link($URL) );
    }
    
    public function FilterAccomodations() {
        $fields = new FieldList(
            DropdownField::create('Country', _t(
                'AcademicsSearchForm.COUNTRY',
                'Country'), $this->countryOptions)->setEmptyString('Select a country')->addExtraClass('filter-by-country chosen-select'),
            DropdownField::create('City', _t(
                'AcademicsSearchForm.COUNTRY',
                'City'))->setEmptyString('Select a city')->addExtraClass('filter-by-city chosen-select'),
            DropdownField::create('Type', _t(
                'AcademicsSearchForm.DEFAULT',
                'Type'), array('Homestay', 'Hotel', 'Apartment', 'Room Share', 'Roommate', 'Sublet'))->setEmptyString('Select Accomodation Type')->addExtraClass('chosen-select')
        );
        
        $actions = FieldList::create(
            FormAction::create('doAccomodationsSearch', _t(
                'MemberProfileForms.DEFAULT',
                'Search'))->addExtraClass('btn btn-primary')
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
            DropdownField::create('Country', 'Country', $this->countryOptions, Controller::curr()->getRequest()->param('Country'))->setEmptyString('Select a country')->addExtraClass('chosen-select'),
            DropdownField::create('Service', 'Service Requested', Service::getServiceOptions(), Controller::curr()->getRequest()->param('Service'))->setEmptyString('Name of Service')->addExtraClass('chosen-select')
        );
        
        $actions = FieldList::create(
            FormAction::create('doAgentsSearch', _t(
                'MemberProfileForms.DEFAULT',
                'Search'))->addExtraClass('btn btn-primary'),
            new LiteralField('ClearFields', '<a href="'.AgentPortalPage::get()->First()->Link('search').'" class="btn btn-default">Clear Fields</a>')
        );
        
        $required = new RequiredFields(array(
        ));
        
        return new Form($this->owner, 'FilterAgents', $fields, $actions, $required);
    }
    
    public function doAgentsSearch(array $data, Form $form) {
        $URL = 'search/';
        
        $URL .= $data['Country'] == '' ? '0/' : $data['Country'].'/'; 
        $URL .= $data['Service'] == '' ? '0/' : $data['Service'].'/'; 
                
        return $this->owner->redirect(AgentPortalPage::get()->First()->Link($URL));
    }
    
    public function FilterMentors() {
        $fields = new FieldList(
            DropdownField::create('Country', _t(
                'AcademicsSearchForm.COUNTRY',
                'Country'), $this->countryOptions)->setEmptyString('Select a country')->addExtraClass('filter-by-country chosen-select'),
            DropdownField::create('City', _t(
                'AcademicsSearchForm.COUNTRY',
                'City'))->setEmptyString('Select a city')->addExtraClass('filter-by-city chosen-select'),
            DropdownField::create('Request', _t(
                'AcademicsSearchForm.COUNTRY',
                'Request Type'), array('City Orientation', 'Academic Orientation', 'Events', 'Workshops', 'Tutoring'))->setEmptyString('What do you need?')->addExtraClass('chosen-select')
        );
        
        $actions = FieldList::create(
            FormAction::create('doMentorsSearch', _t(
                'MemberProfileForms.DEFAULT',
                'Search'))->addExtraClass('btn btn-primary')
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