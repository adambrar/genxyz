<?php

class CustomSiteConfig extends DataExtension {

    private static $db = array(
        'Scholarships' => 'HTMLText',
        'HighlightofMonth' => 'HTMLText',
        'SpecialThanks' => 'HTMLText',
        'FacebookLink' => 'Varchar(150)',
        'YoutubeLine' => 'Varchar(150)',
        'GoogleLink' => 'Varchar(150)',
        'LinkedInLink' => 'Varchar(150)',
        'AddressLine1' => 'Varchar(150)',
        'AddressLine2' => 'Varchar(150)',
        'PhoneNumber' => 'Varchar(20)'
    );
    
    private static $has_one = array(
        'DefaultProfilePicture' => 'Image',
        'DefaultSchoolLogo' => 'Image',
        'DefaultAgentLogo' => 'Image'
    );

    public function updateCMSFields(FieldList $fields) {
        $defaultProfile = new UploadField('DefaultProfilePicture', 'Upload a default profile picture photo.');
        $defaultProfile->setAllowedFileCategories('image');
        $defaultProfile->setAllowedMaxFileNumber(1);
        $defaultProfile->setFolderName('Uploads/defaults');
        $defaultSchoolLogo = new UploadField('DefaultSchoolLogo', 'Upload a default School Logo.');
        $defaultSchoolLogo->setAllowedFileCategories('image');
        $defaultSchoolLogo->setAllowedMaxFileNumber(1);
        $defaultSchoolLogo->setFolderName('Uploads/defaults');
        $defaultAgentLogo = new UploadField('DefaultAgentLogo', 'Upload a default Agent Logo.');
        $defaultAgentLogo->setAllowedFileCategories('image');
        $defaultAgentLogo->setAllowedMaxFileNumber(1);
        $defaultAgentLogo->setFolderName('Uploads/defaults');

        $fields->addFieldToTab('Root.Main', $defaultProfile);
        $fields->addFieldToTab('Root.Main', $defaultSchoolLogo);
        $fields->addFieldToTab('Root.Main', $defaultAgentLogo);
        $fields->addFieldToTab('Root.Main', new TextField('AddressLine1', 'Address Line 1'));
        $fields->addFieldToTab('Root.Main', new TextField('AddressLine2', 'Address Line 2'));
        $fields->addFieldToTab('Root.Main', new TextField('PhoneNumber', 'Phone Number'));

        $fields->addFieldToTab('Root.Footer', new LiteralField('SocialMediaLinks', '<h2>Social Media Links</h2>'));
        $fields->addFieldToTab('Root.Footer', new TextField('FacebookLink', 'Facebook Link'));
        $fields->addFieldToTab('Root.Footer', new TextField('YoutubeLink', 'Twitter Link'));
        $fields->addFieldToTab('Root.Footer', new TextField('GoogleLink', 'Snapchat Link'));
        $fields->addFieldToTab('Root.Footer', new TextField('LinkedInLink', 'Instagram Link'));
        
        $fields->addFieldToTab('Root.Footer', new LiteralField('FooterContent', '<h2>Footer Content</h2>'));

        $fields->addFieldToTab('Root.Footer', new HTMLEditorField('Scholarships', 'Scholarships Content'));
        $fields->addFieldToTab('Root.Footer', new HTMLEditorField('HighlightofMonth', 'Highlight of the Month'));
        $fields->addFieldToTab('Root.Footer', new HTMLEditorField('SpecialThanks', 'Special Thanks To'));

    }
}