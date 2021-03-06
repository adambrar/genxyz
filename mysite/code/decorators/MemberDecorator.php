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
    
    private static $has_many = array(
        'Ratings' => 'Rating'
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
    
    public function IsSuspended() {
		if($this->owner->SuspendedUntil) {
			return strtotime(SS_Datetime::now()->Format('Y-m-d')) < strtotime($this->SuspendedUntil);
		} else {
			return false; 
		}
	}

	public function IsBanned() {
		return $this->owner->ForumStatus == 'Banned';
	}

	public function IsGhost() {
		return $this->owner->ForumStatus == 'Ghost' && $this->owner->ID !== Member::currentUserID();
	}
    
    function isModeratingForum($forum) {
		$moderatorIds = $forum->Moderators() ? $forum->Moderators()->getIdList() : array();
		return in_array($this->owner->ID, $moderatorIds);
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
}