<?php

global $project;
$project = 'mysite';

global $databaseConfig;
$databaseConfig = array(
	"type" => 'MySQLDatabase',
	"server" => 'localhost',
	"username" => 'silver',
	"password" => 'silverasdf1234',
	"database" => 'genxyz',
	"path" => '',
);

// Set the site locale
i18n::set_locale('en_US');

// Remove when live
Director::set_environment_type('dev');
error_reporting(E_ALL);

SSViewer::set_theme('one');

Member::set_unique_identifier_field('Email');

//set password requiresments
$validator = new PasswordValidator();
$validator->minLength(8);
$validator->characterStrength(2, array('lowercase', 'uppercase', 'digits', 'punctuation'));
$validator->checkHistoricalPasswords(3);

Member::set_password_validator($validator);

Member::lock_out_after_incorrect_logins(4);

HTMLEditorConfig::get('cms')->setOption('valid_elements', '*[*]');
HTMLEditorConfig::get('cms')->setOption('invalid_elements', 'script');

Object::useCustomClass('MemberLoginForm', 'GroupRedirectLoginForm');

Object::add_extension('Member', 'MemberDecorator');

Object::add_extension('BlogHolder', 'BlogHolderDecorator');
Object::add_extension('BlogHolder_Controller', 'BlogHolder_ControllerDecorator');

Object::add_extension('BlogEntry', 'BlogEntryDecorator');

Object::add_extension('BlogTree', 'BlogTreeDecorator');
Object::add_extension('BlogTree_Controller', 'BlogTree_ControllerDecorator');

Object::add_extension('CommentingController', 'CommentingControllerDecorator');

Object::add_extension('ForumHolder', 'ForumHolderDecorator');

//Object::add_extension('MemberProfilePage_Controller', 'MemberProfilePage_ControllerDecorator');
//
//Object::add_extension('MemberProfileViewer', 'MemberProfileViewerDecorator');

SiteTree::add_extension('Translatable');