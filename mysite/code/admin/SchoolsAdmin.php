<?php

class SchoolsAdmin extends ModelAdmin {
    
    private static $managed_models = array(
        'School'
    );
    
    private static $url_segment = 'schools';
    
    private static $menu_title = 'Schools';
    
    private static $menu_icon = 'mysite/icons/Letter_S_grey_Icon_16.png';
    
}