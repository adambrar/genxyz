<?php

class StudentsAdmin extends ModelAdmin {
    
    private static $managed_models = array(
        'Student'
    );
    
    private static $url_segment = 'students';
    
    private static $menu_title = 'Students';
    
    private static $menu_icon = 'mysite/icons/Letter_S_grey_Icon_16.png';
}