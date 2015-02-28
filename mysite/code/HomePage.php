<?php 
 
class HomePage extends Page 
{
     
}
 
class HomePage_Controller extends Page_Controller 
{
    
    function LatestBlogPosts($num=4) {
        $holder = BlogEntry::get()->First();
        return ($holder) ? BlogEntry::get()->limit($num) : false;    
    }
    
    function AllForums($num=3) {
        $holder = Forum::get()->First();
        return ($holder) ? Forum::get()->limit($num) : false;    
    }
     
}