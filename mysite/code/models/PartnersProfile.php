<?php

class PartnersProfile extends DataObject {
    
    private static $db = array(
        'WelcomeVideoLink' => 'Varchar(200)',
        'Testimonial1' => 'HTMLText',
        'Testimonial2' => 'HTMLText',
        'Testimonial3' => 'HTMLText',
        'MissionStatement' => 'HTMLText',
        'Values' => 'HTMLText',
        'Vision' => 'HTMLText',
        'ContactInfo' => 'HTMLText',
        'Scholarships' => 'HTMLText',
        'AdmissionRequirements' => 'Varchar(100)',
        'EnglishRequirements' => 'Varchar(100)',
        'ProcessingTime' => 'Varchar(100)',
        'Fees' => 'Varchar(100)',
        'Application' => 'Varchar(100)'        
    );
    
    private static $belongs_to = array(
        'Partner' => 'Member'
    );
    
    private static $has_one = array(
        'LogoImage' => 'Image',
        'SlideOne' => 'Image',
        'SlideTwo' => 'Image',
        'SlideThree' => 'Image',
    );
    
}