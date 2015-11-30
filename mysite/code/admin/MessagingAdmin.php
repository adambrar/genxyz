<?php

class MessagingAdmin extends ModelAdmin {
    
    private static $managed_models = array(
        'MessageThread'
    );
    
    private static $url_segment = 'messaging';
    
    private static $menu_title = 'Messaging';
    
    private static $menu_icon = 'mysite/icons/Letter_A_grey_Icon_16.png';
    
}