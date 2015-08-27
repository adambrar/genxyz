<?php 
 
class HomePage extends Page 
{
    private static $db = array(
        'WelcomeTitle' => 'Text',
        'WelcomeMessage' => 'Text',
        'MediaUpdates' => 'HTMLText',
        'InteractiveUpdates' => 'HTMLText'
    );

    private static $defaults = array(
        'menuShown' => 'Welcome',
        'menuWelcome' => true
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
              
        $fields->addFieldToTab("Root.Main", new TextareaField('WelcomeTitle', 'Welcome Title'));      
        $fields->addFieldToTab("Root.Main", new TextareaField('WelcomeMessage', 'Welcome Message'));
        $fields->addFieldToTab("Root.Main", new HtmlEditorField('MediaUpdates', 'Media Updates'));
        $fields->addFieldToTab("Root.Main", new HtmlEditorField('InteractiveUpdates', 'Interactive Updates'));
        
        $fields->removeByName("Content");

        return $fields;
    }
}
 
class HomePage_Controller extends Page_Controller 
{
    /**
    * Gets latest blog posts, excluding account creation posts and 
    * posts by GenXYZ (removes GenXYZ tag)
    **/
    function StudentBlogPosts($num=4) {
        $id = BlogHolder::get()->filter('Title', 'GenXYZ')->First()->ID;

        $entry = SiteTree::get()->filter(array(
            'ClassName' => 'BlogEntry'            
        ))->exclude('ParentID', $id)->First();
        
        return ($entry) ? SiteTree::get()->filter(array('ClassName' => 'BlogEntry'))->exclude(array('ParentID' => $id))->sort('Created', 'DESC')->limit($num) : false;    
    }
    
    /**
    * Gets latest blog posts, from GenXYZ Blog Holder
    **/
    function GenXYZBlogPosts($num=4) {
        $holder = BlogHolder::get()->filter(array(
            'Title' => 'GenXYZ'
        ))->First();
        
        if(!$holder) { return false; }
            
        $entry = BlogEntry::get()->filter('ParentID', $holder->ID)->First();

        return ($entry) ? BlogEntry::get()->filter('ParentID', $holder->ID)->sort('Date', 'DESC')->limit($num) : false;
    }
    
    function AllForums($num=5) {
        $holder = Forum::get()->First();
        
        if(!$holder) { return false; }
        
        return ($holder) ? Forum::get()->limit($num) : false;    
    }
     
}