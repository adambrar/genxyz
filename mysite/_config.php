<?php

global $project;
$project = 'mysite';

global $databaseConfig;
$databaseConfig = array(
	"type" => 'MySQLDatabase',
	"server" => 'localhost',
	"username" => 'root',
	"password" => '',
	"database" => 'SS_mysite',
	"path" => '',
);

// Set the site locale
i18n::set_locale('en_US');

// Remove when live
Director::set_environment_type('dev');

HTMLEditorConfig::get('cms')->setOption('valid_elements', '*[*]');
HTMLEditorConfig::get('cms')->setOption('invalid_elements', 'script');
