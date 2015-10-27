<?php
class BlogTreeDecorator extends DataExtension {
     
    private static $has_one = array(
        'SideBarWidget' => 'WidgetArea'
    );
    
    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab("Root.Widgets", new WidgetAreaEditor("SideBarWidget"));
    }
    
    public function getDates() {			
			$results = new ArrayList();
			$container = BlogTree::current();
			$ids = $container->BlogHolderIDs();
			
			$stage = Versioned::current_stage();
			$suffix = (!$stage || $stage == 'Stage') ? "" : "_$stage";

			if(method_exists(DB::getConn(), 'formattedDatetimeClause')) {
				$monthclause = DB::getConn()->formattedDatetimeClause('"Date"', '%m');
				$yearclause  = DB::getConn()->formattedDatetimeClause('"Date"', '%Y');
			} else {
				$monthclause = 'MONTH("Date")';
				$yearclause  = 'YEAR("Date")';
			}
			
			$sqlResults = DB::query("
                SELECT DISTINCT CAST($monthclause AS " . DB::getConn()->dbDataType('unsigned integer') . ")
                    AS \"Month\",
                    $yearclause AS \"Year\"
                FROM \"SiteTree$suffix\" INNER JOIN \"BlogEntry$suffix\"
                    ON \"SiteTree$suffix\".\"ID\" = \"BlogEntry$suffix\".\"ID\"
                WHERE \"ParentID\" IN (" . implode(', ', $ids) . ")
                ORDER BY \"Year\" DESC, \"Month\" DESC;"
            );
			
			if($sqlResults) foreach($sqlResults as $sqlResult) {
				$isMonthDisplay = true;
				
				$monthVal = (isset($sqlResult['Month'])) ? (int) $sqlResult['Month'] : 1;
				$month = ($isMonthDisplay) ? $monthVal : 1;
				$year = ($sqlResult['Year']) ? (int) $sqlResult['Year'] : date('Y');
				
				$date = DBField::create_field('Date', array(
					'Day' => 1,
					'Month' => $month,
					'Year' => $year
				));
				
				if($isMonthDisplay) {
					$link = $container->Link('date') . '/' . $sqlResult['Year'] . '/' . sprintf("%'02d", $monthVal);
				} else {
					$link = $container->Link('date') . '/' . $sqlResult['Year'];
				}
				
				$results->push(new ArrayData(array(
					'Date' => $date,
					'Link' => $link
				)));
			}
			
			return $results;
		}
    
}