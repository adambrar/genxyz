<?php
class MemberDecorator extends DataExtension {        
    
    private static $db = array(
		'ValidationKey'   => 'Varchar(40)',
		'NeedsValidation' => 'Boolean',
		'NeedsApproval'   => 'Boolean',
        //Forum values
        'LastViewed' => 'SS_Datetime',
        'ForumStatus' => 'Enum("Normal, Banned, Ghost", "Normal")',
        'SuspendedUntil' => 'Date',
        'ForumRank' => 'Varchar'
	);
    
    private static $belongs_many_many = array(
        'ModeratedForums' => 'Forum'
    );
    
    public function populateDefaults() {
        $this->owner->ValidationKey = sha1(mt_rand().mt_rand());
    }
    
    public function updateCMSFields(FieldList $fields) {
        $fields->removeByName('ValidationKey');
        $fields->removeByName('NeedsValidation');
        $fields->removeByName('NeedsApproval');
        
        if($this->owner->NeedsApproval) {
			$note = 'This user has not yet been approved. They cannot log in until their account is approved.';

			$fields->addFieldsToTab('Root.Main', array(
				new HeaderField('ApprovalHeader', 'Registration Approval'),
				new LiteralField('ApprovalNote', "<p>$note</p>"),
				new DropdownField('NeedsApproval', '', array(
					true  => 'Do not change',
					false => 'Approve this member'
				))
			));
		}
        
        if($this->owner->NeedsValidation) {
            $fields->addFieldsToTab('Root.Main', array(
                new HeaderField('ConfirmationHeader', _t('MemberProfiles.EMAILCONFIRMATION', 'Email Confirmation')),
                new LiteralField('ConfirmationNote', '<p>The member cannot log in until their account is confirmed.</p>'),
                new DropdownField('ManualEmailValidation', '', array (
                    'unconfirmed' => 'Unconfirmed',
                    'resend'      => 'Resend confirmation email',
                    'confirm'     => 'Manually confirm'
                ))
            ));
        }
    }
    
    public function saveManualEmailValidation($value) {
		if($value == 'confirm') {
			$this->owner->NeedsValidation = false;
		} elseif($value == 'resend') {
			$email = new MemberConfirmationEmail($this->owner->ProfilePage(), $this->owner);
			$email->send();
		}
	}
    
    public function canLogIn($result) {
		if($this->owner->NeedsApproval) $result->error(_t (
			'MemberProfiles.NEEDSAPPROVALTOLOGIN',
			'An administrator must confirm your account before you can log in.'
		));

		if($this->owner->NeedsValidation) $result->error(_t (
			'MemberProfiles.NEEDSVALIDATIONTOLOGIN',
			'You must validate your account before you can log in.'
		));
	}
    
    public function getLatestForumPosts($max = null) {
        if(!Member::currentUserID()) {
            return false;
        }
        if($max) {
            $posts = Post::get()->filter(array(
                'AuthorID' => $this->owner->ID
            ))->sort('Created', 'DESC')->limit($max);
        } else {
            $posts = Post::get()->filter(array(
                'AuthorID' => $this->owner->ID
            ))->sort('Created', 'DESC');
        }
        
        return $posts ? $posts : false;
    }
    
    public function getBlogHolder() {
        if(!Permission::check('BLOGMANAGEMENT')) {
            return false;
        }
        
        $holder = BlogHolder::get()->filter(array(
            'ownerID' => $this->owner->ID
        ))->First();
        
        if(!$holder) {
            $holder = $this->createNewStudentBlog();
            $this->BlogHolderID = $holder->ID;
            $this->owner->write();
        }
            
        
        return $holder ? $holder : false;
    }
        
        private function createNewStudentBlog() {
        $blogHolder = new BlogHolder();
        $blogHolder->Title = $this->owner->FirstName."-".$this->owner->Surname."-".$this->owner->ID;
        $blogHolder->AllowCustomAuthors = false;
        $blogHolder->OwnerID = $this->owner->ID;
        $blogHolder->URLSegment = $this->owner->FirstName."-".$this->owner->Surname."-".$this->owner->ID;
        $blogHolder->Status = "Published";
        $blogHolder->ParentID = SiteTree::get()->Filter('ClassName','BlogTree')->First()->ID;
        Debug::show(SiteTree::get()->Filter('ClassName','BlogTree')->First()->ID);
        $blogHolder->write();
        $blogHolder->doRestoreToStage();
        
        //create welcome blog entry
        $blog = new BlogEntry();
        $blog->Title = "Welcome to GenXYZ " . $this->owner->FirstName . "!";
        $blog->Author = "Admin";
        $blog->URLSegment = 'first-post';
        $blog->Tags = "created, first, welcome";
        $blog->Content = "<p>Thank you for registering with the GenXYZ. Take a look around.</p>";
        $blog->Status = "Published";
        $blog->ParentID = $blogHolder->ID;
        $blog->write();
        $blog->doRestoreToStage();
        
        return $blogHolder;
    }
        
    
    //get latest blog posts for member
    public function getLatestBlogEntries($member = null, $max = 5) {
        if(!$member) {
            return false;
        }

        $holder = BlogHolder::get()->filter(array(
            'ownerID' => $member->ID
        ))->First();

        if(!$holder) {
            return false;
        }
        
        $entries = SiteTree::get()->filter(array(
            'ParentID' => $holder->ID
        ))->limit($max);
        
        return $entries;
    }  
}