<?php

class CustomSiteConfig extends DataExtension {

    private static $db = array(
        'Scholarships' => 'HTMLText',
        'HighlightofMonth' => 'HTMLText',
        'SpecialThanks' => 'HTMLText',
        'Address' => 'HTMLText'
    );
    
    private static $has_one = array(
        'DefaultProfilePicture' => 'Image'
    );

    public function updateCMSFields(FieldList $fields) {
        $imageUpload = new FileField('DefaultProfilePictureID', 'Upload a default profile picture photo.');
        $imageUpload->getValidator()->allowedExtensions = array('jpg', 'png');
        //$imageUpload->setFolderName($imageUpload->getFolderName() . '/ProfilePictures');

        $fields->addFieldToTab("Root.Main", $imageUpload);
        
        $fields->addFieldToTab("Root.Main", new HTMLEditorField("Scholarships", "Scholarships Content"));
        $fields->addFieldToTab("Root.Main", new HTMLEditorField("HighlightofMonth", "Highlight of the Month"));
        $fields->addFieldToTab("Root.Main", new HTMLEditorField("SpecialThanks", "Special Thanks To"));
        $fields->addFieldToTab("Root.Main", new HTMLEditorField("Address", "Address"));
        
    }
}