<?php
/**
 *
 * Homestay class extends Member for for agencies
 *
 */

class Agent extends Member {
    
    private static $db = array(
        'Website' => 'Varchar(200)',
        'AboutMe' => 'Varchar(200)',
        'AddressLine1' => 'Varchar(200)',
        'AddressLine2' => 'Varchar(200)',
        'City' => 'Varchar(200)',
        'PostalCode' => 'Varchar(10)',
        'PhoneNumber' => 'Varchar(20)'
    );
    
    private static $has_one = array(
        'Logo' => 'Image',
        'Nationality' => 'Country',
        'Country' => 'Country'
    );
    
    private static $has_many = array(
        'Services' => 'Service',
        'SchoolApplications' => 'SchoolApplication',
        'MessageThreads' => 'MessageThread'
    );
    
    private static $many_many = array(
        'Schools' => 'School'
    );
    
    private static $summary_fields = array(
        'Name' => 'Name',
        'Email' => 'Email',
        'Country.Name' => 'Country'
    );
    
    private static $searchable_fields = array(
        'Email' => 'PartialMatchFilter',
        'FirstName' => 'PartialMatchFilter',
        'Surname' => 'PartialMatchFilter',
        'Country.Name' => 'PartialMatchFilter'
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $this->removeExtraFields($fields);
        
        $fieldList = array('Website', 'AddressLine1', 'AddressLine2', 'PostalCode', 'PhoneNumber', 'City', 'CountryID');
        
        foreach($fieldList as $field) {
            $tabField = $fields->dataFieldByName($field);
            $fields->removeFieldFromTab('Root.Main', $field);
            $fields->addFieldToTab('Root.Contact', $tabField);
        }
        
        $fields->dataFieldByName('Logo')->setFolderName('agents/'.$this->ID.'/Logos');
        
        return $fields;
    }
    
    /* 
     * Remove unused fields from member form in CMS
     */
    private function removeExtraFields(FieldList $fields) {
        
        $fields->removeByName('Country');
    }
    
    public function viewLink() {
        return AgentPortalPage::get()->First()->Link('show/'.$this->ID);
    }
    
    public function editLink() {
        return AgentPortalPage::get()->First()->Link('edit');
    }
    
    public function DoneApplications() {
        return $this->SchoolApplications()->filter('Status', 'Completed');
    }
    
    public function InProcessApplications() {
        return $this->SchoolApplications()->exclude('Status', 'Completed');
    }
    
    public function getBlogHolder() {
        $holder = BlogHolder::get()->filter('OwnerID', $this->ID)->First();
        if($holder) {
            return $holder;
        }
        $blogTree = SiteTree::get()->filter(array(
            'ClassName' => 'BlogTree',
            'Title' => 'Agent Blogs'
        ))->First();
        
        //create new blog tree if not exists        
        if(!$blogTree) {
            $blogTree = new blogTree();
            $blogTree->Title = "Agent Blogs";
            $blogTree->URLSegment = "agent-blogs";
            $blogTree->Status = "Published";
            $blogTree->write();
            $blogTree->doRestoreToStage();
        }
        
        return $this->createNewAgentBlog($blogTree);
    }
    
    public function createNewAgentBlog(BlogTree $blogTree) {
        $blogHolder = new BlogHolder();
        $blogHolder->Title = $this->Name." ".$this->ID."'s Blog";
        $blogHolder->AllowCustomAuthors = false;
        $blogHolder->OwnerID = $this->ID;
        $blogHolder->URLSegment = $this->FirstName."-".$this->Surname."-".$this->ID;
        $blogHolder->Status = "Published";
        $blogHolder->ParentID = $blogTree->ID;
        
        $widgetArea = new WidgetArea();
        $widgetArea->write();
        
        $blogHolder->SideBarWidgetID = $widgetArea->ID;
        $this->BlogHolder = $blogHolder->write();
        $this->write();
        
        $blogHolder->doRestoreToStage();
        
        //Tag Cloud Widget
        $tagcloudwidget = new TagCloudWidget();
        $tagcloudwidget->ParentID = $widgetArea->ID;
        $tagcloudwidget->Enabled = 1;
        $tagcloudwidget->write();
        //Archive Widget
        $archiveWidget = new ArchiveWidget();
        $archiveWidget->ParentID = $widgetArea->ID;
        $archiveWidget->Enabled = 1;
        $archiveWidget->write();
        
        return $blogHolder;
    }
}