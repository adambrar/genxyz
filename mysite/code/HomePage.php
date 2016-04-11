<?php 
 
class HomePage extends Page 
{
    private static $db = array(
        'WhatIs' => 'HTMLText',
        //---ABOUT US---//
        'AboutUsMessage' => 'HTMLText',
        'AboutUsVision' => 'HTMLText',
        'AboutUsMissionStatement' => 'HTMLText',
        'AboutUsValueOne' => 'Varchar(100)',
        'AboutUsValueTwo' => 'Varchar(100)',
        'AboutUsValueThree' => 'Varchar(100)',
        'AboutUsValueFour' => 'Varchar(100)',
        //---ABOUT US END---//
        //---ACADEMICS---//
        'AcademicsMessage' => 'Text',
        //---ACADEMICS END---//
        //---SERVICES---//
        'ServicesMessage' => 'Text',
        'ServiceOneTitle' => 'Varchar(100)',
        'ServiceOneContent' => 'HTMLText',
        'ServiceOneIcon' => 'Varchar(100)',
        'ServiceTwoTitle' => 'Varchar(100)',
        'ServiceTwoContent' => 'HTMLText',
        'ServiceTwoIcon' => 'Varchar(100)',
        'ServiceThreeTitle' => 'Varchar(100)',
        'ServiceThreeContent' => 'HTMLText',
        'ServiceThreeIcon' => 'Varchar(100)',
        'ServiceFourTitle' => 'Varchar(100)',
        'ServiceFourContent' => 'HTMLText',
        'ServiceFourIcon' => 'Varchar(100)',
        'ServiceFiveTitle' => 'Varchar(100)',
        'ServiceFiveContent' => 'HTMLText',
        'ServiceFiveIcon' => 'Varchar(100)',
        'ServiceSixTitle' => 'Varchar(100)',
        'ServiceSixContent' => 'HTMLText',
        'ServiceSixIcon' => 'Varchar(100)',
        //---SERVICES END---//
        'BlogMessage' => 'Text',
        'ContactMessage' => 'Text'
    );    

    private static $defaults = array(
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
        //---Welcome---//
        $fields->addFieldToTab("Root.Welcome", new TextareaField('WhatIs', 'What Is GenXYZ'));
        //---About Us---//
        $fields->addFieldToTab("Root.About", new HTMLEditorField('AboutUsMessage', 'About Us Message'));
        $fields->addFieldToTab("Root.About", new HTMLEditorField('AboutUsVision', 'Vision'));
        $fields->addFieldToTab("Root.About", new HTMLEditorField('AboutUsMissionStatement', 'Mission Statement'));
        $fields->addFieldToTab("Root.About", new TextField('AboutUsValueOne', 'Value One (100 characters)'));
        $fields->addFieldToTab("Root.About", new TextField('AboutUsValueTwo', 'Value Two'));
        $fields->addFieldToTab("Root.About", new TextField('AboutUsValueThree', 'Value Three'));
        $fields->addFieldToTab("Root.About", new TextField('AboutUsValueFour', 'Value Four'));
        $fields->addFieldToTab("Root.Academics", new TextAreaField('AcademicsMessage', 'Academics Message'));
        //---Services---//
        $fields->addFieldToTab("Root.Services", new TextareaField('ServicesMessage', 'Our Services Message'));
        //One
        $fields->addFieldToTab("Root.Services", new LiteralField('ServiceOne', '<h2>First Service</h2>'));
        $fields->addFieldToTab("Root.Services", new TextField('ServiceOneTitle', 'Service Title'));
        $fields->addFieldToTab("Root.Services", new HTMLEditorField('ServiceOneContent', 'Service Content (100 characters)'));
        $fields->addFieldToTab("Root.Services", new TextField('ServiceOneIcon', 'Service Icon'));
        //Two
        $fields->addFieldToTab("Root.Services", new LiteralField('ServiceTwo', '<h2>Second Service</h2>'));
        $fields->addFieldToTab("Root.Services", new TextField('ServiceTwoTitle', 'Service Title'));
        $fields->addFieldToTab("Root.Services", new HTMLEditorField('ServiceTwoContent', 'Service Content (100 characters)'));
        $fields->addFieldToTab("Root.Services", new TextField('ServiceTwoIcon', 'Service Icon'));
        //Three
        $fields->addFieldToTab("Root.Services", new LiteralField('ServiceThree', '<h2>Third Service</h2>'));
        $fields->addFieldToTab("Root.Services", new TextField('ServiceThreeTitle', 'Service Title'));
        $fields->addFieldToTab("Root.Services", new HTMLEditorField('ServiceThreeContent', 'Service Content (100 characters)'));
        $fields->addFieldToTab("Root.Services", new TextField('ServiceThreeIcon', 'Service Icon'));
        //Four
        $fields->addFieldToTab("Root.Services", new LiteralField('ServiceFour', '<h2>Fourth Service</h2>'));
        $fields->addFieldToTab("Root.Services", new TextField('ServiceFourTitle', 'Service Title'));
        $fields->addFieldToTab("Root.Services", new HTMLEditorField('ServiceFourContent', 'Service Content (100 characters)'));
        $fields->addFieldToTab("Root.Services", new TextField('ServiceFourIcon', 'Service Icon'));
        //Five
        $fields->addFieldToTab("Root.Services", new LiteralField('ServiceFive', '<h2>Fifth Service</h2>'));
        $fields->addFieldToTab("Root.Services", new TextField('ServiceFiveTitle', 'Service Title'));
        $fields->addFieldToTab("Root.Services", new HTMLEditorField('ServiceFiveContent', 'Service Content (100 characters)'));
        $fields->addFieldToTab("Root.Services", new TextField('ServiceFiveIcon', 'Service Icon'));
        //Six
        $fields->addFieldToTab("Root.Services", new LiteralField('ServiceSix', '<h2>Sixth Service</h2>'));
        $fields->addFieldToTab("Root.Services", new TextField('ServiceSixTitle', 'Service Title'));
        $fields->addFieldToTab("Root.Services", new HTMLEditorField('ServiceSixContent', 'Service Content (100 characters)'));
        $fields->addFieldToTab("Root.Services", new TextField('ServiceSixIcon', 'Service Icon'));
        
        //Blog
        $fields->addFieldToTab("Root.Blog", new TextareaField('BlogMessage', 'Blog Message'));
        //Contact
        $fields->addFieldToTab("Root.Contact", new TextareaField('ContactMessage', 'Contact Message'));

        $fields->removeByName("Content");

        return $fields;
    }
}
 
class HomePage_Controller extends Page_Controller 
{
    public function FirstGenXYZPost() {
        $holder = BlogHolder::get()->filter('OwnerID', 1)->First();

        if(!$holder->ID) return false;

        $entry = SiteTree::get()->filter(array(
            'ClassName' => 'BlogEntry',
            'ParentID' => $holder->ID
        ))->sort('Created', 'DESC')->First();
        
        return $entry ? $entry : false;
    }
    
    public function LatestBlogPost(int $postNumber) {
        return BlogEntry::get()->exclude('Tags:PartialMatch', 'first')->sort('Created', 'DESC')->limit(1,$postNumber-1)->First();
    }
    
    public function LatestMagazinePost(int $postNumber) {
        $blogHolder = BlogHolder::get()->filter('ParentID', '0')->First();
        
        return BlogEntry::get()->filter('ParentID', $blogHolder->ID)->sort('Created', 'DESC')->limit(1,$postNumber-1)->First();
    }
    
    public function isHomePage() { return true; }
}