<?php 
 
class HomePage extends Page 
{
    private static $db = array(
        'WelcomeTitle' => 'Text',
        'WelcomeMessage' => 'Text',
        'MediaUpdates' => 'HTMLText',
        'InteractiveUpdates' => 'HTMLText'
    );
    
    private static $has_one = array(
        'Image1' => 'Image',
        'Image2' => 'Image',
        'Image3' => 'Image',
        'Image4' => 'Image'
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
        $fields->addFieldToTab("Root.Photos", new LiteralField('PhotoSizeWarning', '<h2>Only upload photos sized at 1700 by 900!</h2>'));
        $UploadField = new UploadField('Image1', 'Upload first slideshow image');
        $UploadField->setAllowedFileCategories('image');
        $UploadField->setAllowedMaxFileNumber(1);
        $UploadField->setFolderName('homepage/slides');
        $fields->addFieldToTab("Root.Photos", $UploadField);
        $UploadField = new UploadField('Image2', 'Upload second slideshow image');
        $UploadField->setAllowedFileCategories('image');
        $UploadField->setAllowedMaxFileNumber(1);
        $UploadField->setFolderName('homepage/slides');
        $fields->addFieldToTab("Root.Photos", $UploadField);
        $UploadField = new UploadField('Image3', 'Upload third slideshow image');
        $UploadField->setAllowedFileCategories('image');
        $UploadField->setAllowedMaxFileNumber(1);
        $UploadField->setFolderName('homepage/slides');
        $fields->addFieldToTab("Root.Photos", $UploadField);
        $UploadField = new UploadField('Image4', 'Upload fourth slideshow image');
        $UploadField->setAllowedFileCategories('image');
        $UploadField->setAllowedMaxFileNumber(1);
        $UploadField->setFolderName('homepage/slides');
        $fields->addFieldToTab("Root.Photos", $UploadField);
        
        
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