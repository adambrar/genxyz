<?php

class CustomSiteConfig extends DataExtension {

    private static $db = array(
        'Scholarships' => 'HTMLText',
        'HighlightofMonth' => 'HTMLText',
        'SpecialThanks' => 'HTMLText',
        'Address' => 'HTMLText'
    );

    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab("Root.Main", new HTMLEditorField("Scholarships", "Scholarships Content"));
        $fields->addFieldToTab("Root.Main", new HTMLEditorField("HighlightofMonth", "Highlight of the Month"));
        $fields->addFieldToTab("Root.Main", new HTMLEditorField("SpecialThanks", "Special Thanks To"));
        $fields->addFieldToTab("Root.Main", new HTMLEditorField("Address", "Address"));
        
    }
}