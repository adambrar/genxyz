<?php 
 
class AcademicsPage extends Page 
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
              
        $fields->addFieldToTab("Root.Main", new HTMLEditorField('Updates', 'About'));      
        $fields->addFieldToTab("Root.Main", new HTMLEditorField('RecentlyAdded', 'Recently Added'));
        
        $fields->removeByName("Content");

        return $fields;
    }
}
 
class AcademicsPage_Controller extends Page_Controller 
{
    private static $allowed_actions = array(
        'FilterAcademics',
        'search',
        'show',
        'searchprogramsasjson',
        'searchcountriesasjson',
        'doAcademicsSearch'
    );
    
    private static $url_handlers = array(
        'university/$MemberID!' => 'show',
        'agent/$MemberID!' => 'show',
    );
    
    function init() {
        Requirements::javascript(Director::baseFolder() . '/themes/' . SSViewer::current_theme() . '/javascript/academicfilter.js');
        HTMLEditorField::include_js();
        
        parent::init();
        
        if(!Member::currentUserID() || !Member::currentUser()->isStudent()) {
            Security::permissionFailure(null, 'You need to be logged into a student profile to view this content.');
        }
    }
    
    public function show() {
        return new AcademicsProfileViewer($this, 'show');
    }
    
    public function FilterAcademics() {
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h1>' . _t(
                'AcademicsSearchForm.DEFAULT',
                'Filters') . '</h1>'),
            DropdownField::create('Country', _t(
                'AcademicsSearchForm.COUNTRY',
                'Country'))->setEmptyString('Select a country')->addExtraClass('filter-by-country'),
            DropdownField::create('Program', _t(
                'AcademicsSearchForm.DEFAULT',
                'Program'), Program::getProgramOptions())->setEmptyString('Select Program')->addExtraClass('filter-by-program')
        );
        
        $actions = FieldList::create(
            FormAction::create('doAcademicsSearch', _t(
                'MemberProfileForms.DEFAULT',
                'Filter'))->addExtraClass('academic-search-button')
        );
        
        $required = new RequiredFields(array(
            'FirstName',
            'Surname',
            'Email'
        ));
        
        return new Form($this->owner, 'FilterAcademics', $fields, $actions, $required);
    }
    
    public function doAcademicsSearch(array $data, Form $form) {
        if($data['Country'] == '' && $data['Program'] == '') {
            $form->addErrorMessage('Blurb', 'Select filters to search!', 'bad');
            return $this->owner->redirectBack();
        }
        
        $filter = array('MemberType' => 'University');
        
        if($data['Country'] != '') {
            $filter['BusinessCountryID'] = Convert::raw2sql($data['Country']);
        }
        
        $universities = Member::get()->filter($filter);
        
        return $this->owner->redirect(
            $this->Link('?Country='.Convert::raw2sql($data['Country'])
                            .'&Program='.Convert::raw2sql($data['Program'])));

    }
    
    
    public function searchcountriesasjson($message = "", $extraData = null, $status = "success") {
        $this->response->addHeader('Content-Type', 'application/json');
        SSViewer::set_source_file_comments(false);
		if($status != "success") {
			$this->setStatusCode(400, $message);
		}
		// populate Javascript
		$js = array();
        $js[] = array(
            'title' => 'first',
            'value' => 'firstvalue'
        );
        
        $countries = Country::get()->filter(array(
            'ID' => 'Members.BusinessCountryID'
        ))->sort('Name', 'ASC');
        
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
    
    public function PaginatedUniversities() {
        $filter = array('MemberType' => 'University');
        
        if($this->request->getVar('Country') != '' && 
           ctype_digit($this->request->getVar('Country'))) {
            $filter['BusinessCountryID'] = Convert::raw2sql($this->request->getVar('Country'));
        }
        
        $reqProgram = $this->request->getVar('Program');
        if($reqProgram != '' && ctype_digit($reqProgram)) {
            $filter['Programs.ProgramNameID'] = Convert::raw2sql($this->request->getVar('Program'));
        }
        
        $list = Member::get()->filter($filter);

        $paginated = new PaginatedList($list, Controller::curr()->request);
        
        $paginated->setPageLength(25);
        
        return $paginated;
    }
    
    public function getCountryName($id) {
        return Country::getCountryName($id);
    }
    
    public function LogoLink($id) {
        $member = Member::get()->ByID($id);
        if(!$member || $member->isStudent($member) || !$member->PartnersProfileID)
            return false;
        
        $profile = PartnersProfile::get()->ByID($member->PartnersProfileID);
        if(!$profile || !$profile->LogoImageID) {
            return Director::baseURL() . 'assets/Uploads/default.jpg';
        } else {
            return File::get()->filter(array(
                'ClassName' => 'Image',
                'ID'        => $profile->LogoImageID
            ))->First()->Link();
        }    
    }
}