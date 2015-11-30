<?php

class CustomSiteConfig extends DataExtension {

    private static $db = array(
        'Scholarships' => 'HTMLText',
        'HighlightofMonth' => 'HTMLText',
        'SpecialThanks' => 'HTMLText',
        'FacebookLink' => 'Varchar(150)',
        'TwitterLink' => 'Varchar(150)',
        'SnapchatLink' => 'Varchar(150)',
        'InstagramLink' => 'Varchar(150)',
        'AddressLine1' => 'Varchar(150)',
        'AddressLine2' => 'Varchar(150)',
        'PhoneNumber' => 'Varchar(20)'
    );
    
    private static $has_one = array(
        'DefaultProfilePicture' => 'Image'
    );

    public function updateCMSFields(FieldList $fields) {
        $imageUpload = new UploadField('DefaultProfilePicture', 'Upload a default profile picture photo.');
        $imageUpload->setAllowedFileCategories('image');
        $imageUpload->setAllowedMaxFileNumber(1);
        $imageUpload->setFolderName('Uploads');

        $fields->addFieldToTab('Root.Main', $imageUpload);
        $fields->addFieldToTab('Root.Main', new TextField('AddressLine1', 'Address Line 1'));
        $fields->addFieldToTab('Root.Main', new TextField('AddressLine2', 'Address Line 2'));
        $fields->addFieldToTab('Root.Main', new TextField('PhoneNumber', 'Phone Number'));

        $fields->addFieldToTab('Root.Footer', new LiteralField('SocialMediaLinks', '<h2>Social Media Links</h2>'));
        $fields->addFieldToTab('Root.Footer', new TextField('FacebookLink', 'Facebook Link'));
        $fields->addFieldToTab('Root.Footer', new TextField('TwitterLink', 'Twitter Link'));
        $fields->addFieldToTab('Root.Footer', new TextField('SnapchatLink', 'Snapchat Link'));
        $fields->addFieldToTab('Root.Footer', new TextField('InstagramLink', 'Instagram Link'));
        
        $fields->addFieldToTab('Root.Footer', new LiteralField('FooterContent', '<h2>Footer Content</h2>'));

        $fields->addFieldToTab('Root.Footer', new HTMLEditorField('Scholarships', 'Scholarships Content'));
        $fields->addFieldToTab('Root.Footer', new HTMLEditorField('HighlightofMonth', 'Highlight of the Month'));
        $fields->addFieldToTab('Root.Footer', new HTMLEditorField('SpecialThanks', 'Special Thanks To'));

    }
}