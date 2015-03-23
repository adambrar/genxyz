<?php
    
class UniversityTest extends SapphireTest {
    static $fixture_file = 'mysite/tests/UniversityTest.yml';
    
    function testGetUniversityTitle() {
        $uni = $this->objFromFixture('University', 'firstuni');
        
        $this->assertEquals('First Uni', $uni->Title);
    }
    
    function testGetUniversityOptions() {
        $universityOptions = University::getUniversityOptions();
        
        $this->assertEquals($universityOptions->count(), 3);
        $this->assertEquals($universityOptions[1], 'First Uni');
        $this->assertEquals($universityOptions[2], 'Second Uni');
        $this->assertEquals($universityOptions[33], 'Third Uni');
    }
    
}