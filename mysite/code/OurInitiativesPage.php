<?php 
 
class OurInitiativesPage extends Page 
{
    private static $db = array(
        'Introduction' => 'Text',
        'ScholarshipOpportunities' => 'Text',
        'SocialEnterprises' => 'Text',
        'NotForProfits' => 'Text',
        'Fundraising' => 'Text',
        'WorkPlacement' => 'Text'
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
              
        $fields->addFieldToTab("Root.Main", new TextareaField('Introduction', 'Introduction'));      
        $fields->addFieldToTab("Root.Main", new TextareaField('ScholarshipOpportunities', 'Scholarship Opportunities'));      
        $fields->addFieldToTab("Root.Main", new TextareaField('SocialEnterprises', 'Social Enterprises'));      
        $fields->addFieldToTab("Root.Main", new TextareaField('NotForProfits', 'Not For Profits'));      
        $fields->addFieldToTab("Root.Main", new TextareaField('Fundraising', 'Fundraising'));      
        $fields->addFieldToTab("Root.Main", new TextareaField('WorkPlacement', 'Work Placement'));      

        $fields->removeByName("Content");

        return $fields;
    }
}
 
class OurInitiativesPage_Controller extends Page_Controller 
{
     
}