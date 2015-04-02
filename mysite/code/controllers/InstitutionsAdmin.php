<?php

class MyAdmin extends ModelAdmin {
    
    private static $managed_models = array(
        'University',
        'HighSchool'
    );
    
    private static $url_segment = 'institutions';
    
    private static $menu_title = 'Institutions';
}