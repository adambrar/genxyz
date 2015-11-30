<?php

class ApplicationsAdmin extends ModelAdmin {
    
    private static $managed_models = array(
        'SchoolApplication'
    );
    
    private static $url_segment = 'application';
    
    private static $menu_title = 'Applications';
    
    private static $menu_icon = 'mysite/icons/Letter_A_grey_Icon_16.png';
    
}