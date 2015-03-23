<?php
    
class HighSchoolTest extends SapphireTest {
    static $fixture_file = 'mysite/tests/HighSchoolTest.yml';
    
    function testGetHighSchoolTitle() {
        $school = $this->objFromFixture('HighSchool', 'firstschool');
        
        $this->assertEquals('First School', $school->Title);
    }
    
    function testGetHighSchoolOptions() {
        $schoolOptions = HighSchool::getHighSchoolOptions();
        
        $this->assertEquals($schoolOptions->count(), 3);
        $this->assertEquals($schoolOptions[1], 'First School');
        $this->assertEquals($schoolOptions[2], 'Second School');
        $this->assertEquals($schoolOptions[33], 'Third School');
    }
    
}