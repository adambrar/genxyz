<?php

class PartnersProfile extends DataObject {
    
    private static $db = array(
        'WelcomeVideoLink' => 'Varchar(200)',
        'Testimonial1' => 'Text',
        'Testimonial2' => 'Text',
        'Testimonial3' => 'Text',
        'MissionStatement' => 'HTMLText',
        'Values' => 'HTMLText',
        'Vision' => 'HTMLText',
        'ContactInfo' => 'HTMLText',
        'Scholarships' => 'HTMLText',
        'AdmissionRequirements' => 'Varchar(100)',
        'EnglishRequirements' => 'Varchar(100)',
        'ProcessingTime' => 'Varchar(100)',
        'Fees' => 'Varchar(100)',
        'AboutSchool' => 'Text'
    );
    
    private static $belongs_to = array(
        'Partner' => 'Member'
    );
    
    private static $has_one = array(
        'SlideOne' => 'Image',
        'SlideTwo' => 'Image',
        'SlideThree' => 'Image',
    );
    
}