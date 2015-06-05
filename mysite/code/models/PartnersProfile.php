<?php

class PartnersProfile extends DataObject {
    
    private static $db = array(
        'MissionStatement' => 'Text',
        'Values' => 'Text',
        'Vision' => 'Text',
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
        'LogoImage' => 'Image'
    );
    
}