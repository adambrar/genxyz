<?php
class Page extends SiteTree {

	private static $db = array(
        'menuWelcome' => 'Boolean',
        'menuStudent' => 'Boolean',
        'menuUniversity' => 'Boolean',
        'menuStudentSidebar' => 'Boolean',
        'menuShown' => "Enum('Welcome, Student, University, None')"
	);

	private static $has_one = array(
        
	);
    
    private static $defaults = array(
        'menuShown' => 'Welcome'  
    );
    
    function getSettingsFields() {
        $fields = parent::getSettingsFields();
        
        $fields->addFieldToTab('Root.Settings', new CheckboxField('menuWelcome',"Show up in welcome menu?"), 'ShowInSearch');
        $fields->addFieldToTab('Root.Settings', new CheckboxField('menuStudent',"Show up in student menu?"), 'ShowInSearch');
        $fields->addFieldToTab('Root.Settings', new CheckboxField('menuUniversity',"Show up in university menu?"), 'ShowInSearch');
        $fields->addFieldToTab('Root.Settings', new CheckboxField('menuStudentSidebar',"Show up in student sidebar menu?"), 'ShowInSearch');
        
        $options = array('Welcome', 'Student', 'University');
        $menuOptions = DropdownField::create( 'menuShown', 'Which menu will show on this page?', singleton('WelcomePage')->dbObject('menuShown')->enumValues() )->setEmptyString('Select menu');
        $fields->addFieldToTab('Root.Settings', $menuOptions, 'ShowInSearch');
        
        return $fields;
    }
}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
        'getCMSFields'
	);

	public function init() {
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
	}

}
