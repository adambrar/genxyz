<?php

class StudentReport_RecentlyAdded extends SS_Report {
	public function title() {
		return _t('StudentReport.LAST2WEEKS',"Students Active in the last 2 weeks");
	}
	public function group() {
		return _t('StudentReport.ContentGroupTitle', "Content reports");
	}
	public function sort() {
		return 200;
	}
	public function sourceRecords($params = null) {
		$threshold = strtotime('-14 days', SS_Datetime::now()->Format('U'));
		return DataObject::get("Member", "\"Member\".\"LastVisited\" > '".date("Y-m-d H:i:s", $threshold)."'", "\"Member\".\"LastVisited\" DESC");
	}
	public function columns() {
		return array(
			"FirstName" => array(
				"FirstName" => "FirstName", // todo: use NestedTitle(2)
				"link" => false,
			),
            "Surname" => array(
				"Surname" => "Surname", // todo: use NestedTitle(2)
				"link" => false,
			),
		);
	}
}

class StudentReport_UnknownCountry extends SS_Report {
	public function title() {
		return _t('StudentReport.NOCOUNTRY',"Students without countries added.");
	}
	public function group() {
		return _t('StudentReport.ContentGroupTitle', "Content reports");
	}
	public function sort() {
		return 200;
	}
	public function sourceRecords($params = null) {
		return Member::get()->filter(array(
            'MemberType' => 'Student',
            'CurrentCountryID' => '0'
        ));
	}
	public function columns() {
		return array(
			"FirstName" => array(
				"FirstName" => "FirstName", // todo: use NestedTitle(2)
				"link" => false,
			),
            "Surname" => array(
				"Surname" => "Surname", // todo: use NestedTitle(2)
				"link" => false,
			),
		);
	}
    
    public function getParameterFields() {
		return new FieldList(
			new TextField('FirstName', _t('SideReport.ParameterLiveCheckbox', 'Check live site'))
		);
	}
}

