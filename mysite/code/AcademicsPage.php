<?php 
 
class AcademicsPage extends Page 
{
    
}
 
class AcademicsPage_Controller extends Page_Controller 
{
    private static $allowed_actions = array(
        'SearchForm',
        'search',
        'show',
        'searchcountriesasjson'
    );
    
    private static $url_handlers = array(
        'university/$MemberID!' => 'show',
        'agent/$MemberID!' => 'show',
    );
    
    function init()
    {
        Requirements::javascript('silverstripe/themes/' . SSViewer::current_theme() . '/javascript/academicfilter.js');
        parent::init();
    }
    
    public function show()
    {
        return new AcademicsProfileViewer($this, 'show');
    }
    
    public function search()
    {
    }
    
    public function FilterUniversities()
    {
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>' . _t(
                'MemberProfileForms.DEFAULT',
                'Search Academic Institutions') . '</h2>'),
            DropdownField::create('EducationLevel', _t(
                'MemberProfileForms.EDUCATIONLEVEL',
                'Level of Education') . '<span>*</span>', array(
                    'post-secondary' => 'Post Secondary',
                    'post-graduate' => 'Post Graduate',
                    'secondary' => 'Secondary'))->setEmptyString('Select Level')->addExtraClass('question-1'),
            DropdownField::create('Country', _t(
                'MemberProfileForms.COUNTRY',
                'Country'))->setEmptyString('Select a country')->addExtraClass('question-2 questions'),
            DropdownField::create('ProgramLength', _t(
                'MemberProfileForms.PROGRAMLENGTH',
                'Program Length') . '<span>*</span>', array(
                    'half' => '6 months',
                    '1' => '1 year',
                    '2' => '2 years',
                    '3' => '3 years',
                    '4' => '4 years',
                    '5' => '5 years',
            ))->setEmptyString('Select program length')->addExtraClass('question-3 questions'),
            CountryDropdownField::create('Nationality', _t(
                'MemberProfileForms.DEFAULT',
                'Country'))->addExtraClass('question-4 questions')
        );
        
        $actions = FieldList::create(
            FormAction::create('saveProfileForm', _t(
                'MemberProfileForms.DEFAULT',
                'Search'))->addExtraClass('searchAction')
        );
        
        $required = new RequiredFields(array(
            'FirstName',
            'Surname',
            'Email'
        ));
        
        return new Form($this->owner, 'FilterUniversities', $fields, $actions, $required);
    }
    
    public function searchcountriesasjson($message = "", $extraData = null, $status = "success") 
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
    
}