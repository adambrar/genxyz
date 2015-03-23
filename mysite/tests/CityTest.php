<?php
    
class CityTest extends SapphireTest {
    static $fixture_file = 'mysite/tests/CityTest.yml';
    
    function testGetCityTitle() {
        $city = $this->objFromFixture('City', 'firstcity');
        
        $this->assertEquals('First City', $city->Title);
    }
    
    function testGetCityOptions() {
        $cityOptions = City::getCityOptions();
        
        $this->assertEquals($cityOptions->count(), 3);
        $this->assertEquals($cityOptions[1], 'First City');
        $this->assertEquals($cityOptions[2], 'Second City');
        $this->assertEquals($cityOptions[33], 'Third City');
    }
    
}