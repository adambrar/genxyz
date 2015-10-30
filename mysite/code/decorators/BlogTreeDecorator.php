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
    
    function getTagsCollection($limit = null, $sortBy = null) {
        Requirements::themedCSS("tagcloud");

        // Ensure there is a valid BlogTree with entries
        $container = BlogTree::current();
        if(	!$container
            || !($entries = $container->Entries())
            || $entries->count() == 0
        ) return null;

        // Extract all tags from each entry
        $tagCounts = array(); // Mapping of tag => frequency
        $tagLabels = array(); // Mapping of tag => label
        foreach($entries as $entry) {
            $theseTags = $entry->TagNames();
            foreach($theseTags as $tag => $tagLabel) {
                $tagLabels[$tag] = $tagLabel;
                //getting the count into key => value map
                $tagCounts[$tag] = isset($tagCounts[$tag]) ? $tagCounts[$tag] + 1 : 1;
            }
        }
        if(empty($tagCounts)) return null;
        $minCount = min($tagCounts);
        $maxCount = max($tagCounts);
        
        // Apply sorting mechanism
        if($sortBy == "alphabet") {
            // Sort by name
            ksort($tagCounts);
        } else {
             // Sort by frequency
            uasort($tagCounts, function($a, $b) {
                return $b - $a;
            });
        }
        
        // Apply limiting
        $tagCounts = array_slice($tagCounts, 0, 10, true);

        // Calculate buckets of popularities
        $numsizes = count(array_unique($tagCounts)); //Work out the number of different sizes
        $popularities = array(
			'not-popular',
			'not-very-popular',
			'somewhat-popular',
			'popular',
			'very-popular',
			'ultra-popular'
		);
        $buckets = 6;

        // If there are more frequencies than buckets, divide frequencies into buckets
        if ($numsizes > $buckets) $numsizes = $buckets;

        // Adjust offset to use central buckets (if using a subset of available buckets)
        $offset = round(($buckets - $numsizes)/2);

        $output = new ArrayList();
        foreach($tagCounts as $tag => $count) {

            // Find position of $count in the selected range, adjusted for bucket range used
            if($maxCount == $minCount) {
                $popularity = $offset;
            } else {
                $popularity = round(
                    ($count-$minCount) / ($maxCount-$minCount) * ($numsizes-1)
                ) + $offset;
            }
            $class = $popularities[$popularity];

            $output->push(new ArrayData(array(
                "Tag" => $tagLabels[$tag],
                "Count" => $count,
                "Class" => $class,
                "Link" => Controller::join_links($container->Link('tag'), urlencode($tag))
            )));
        }
        return $output;
    }
    
}