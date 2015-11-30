<?php

class AgentsAdmin extends ModelAdmin {
    
    private static $managed_models = array(
        'Agent'
    );
    
    private static $url_segment = 'agents';
    
    private static $menu_title = 'Agents';
    
    private static $menu_icon = 'mysite/icons/Letter_A_grey_Icon_16.png';
    
}