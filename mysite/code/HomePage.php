<?php 
 
class HomePage extends Page 
{
     
}
 
class HomePage_Controller extends Page_Controller 
{
    /**
    * Gets latest blog posts, excluding account creation posts and 
    * posts by GenXYZ (removes GenXYZ tag)
    **/
    function StudentBlogPosts($num=4) {        
        $entry = BlogEntry::get()->exclude(array(
            'Tags:PartialMatch' => array('created, first, welcome', 'GenXYZ'),
        ))->First();
        
        return ($entry) ? BlogEntry::get()->exclude('Tags:PartialMatch', array('created, first, welcome', 'GenXYZ'))->limit($num)->sort('Date') : false;    
    }
    
    /**
    * Gets latest blog posts, from GenXYZ Blog Holder
    **/
    function GenXYZBlogPosts($num=4) {
        $holder = BlogHolder::get()->filter(array(
            'Title' => 'GenXYZ'
        ))->First();
        $entry = BlogEntry::get()->filter('ParentID', $holder->ID)->First();

        return ($entry) ? BlogEntry::get()->filter('ParentID', $holder->ID)->limit($num)->sort('Date') : false;
    }
    
    function AllForums($num=3) {
        $holder = Forum::get()->First();
        return ($holder) ? Forum::get()->limit($num) : false;    
    }
     
}