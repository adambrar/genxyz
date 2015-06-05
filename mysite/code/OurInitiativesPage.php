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
              
        $fields->addFieldToTab("Root.Main", new TextareaField('Introduction', 'Introduction'), 'Content');      
        $fields->addFieldToTab("Root.Main", new TextareaField('ScholarshipOpportunities', 'Scholarship Opportunities'), 'Content');      
        $fields->addFieldToTab("Root.Main", new TextareaField('SocialEnterprises', 'Social Enterprises'), 'Content');      
        $fields->addFieldToTab("Root.Main", new TextareaField('NotForProfits', 'Not For Profits'), 'Content');      
        $fields->addFieldToTab("Root.Main", new TextareaField('Fundraising', 'Fundraising'), 'Content');      
        $fields->addFieldToTab("Root.Main", new TextareaField('WorkPlacement', 'Work Placement'), 'Content');      

        $fields->removeByName("Content");

        return $fields;
    }
}
 
class OurInitiativesPage_Controller extends Page_Controller 
{
     
}