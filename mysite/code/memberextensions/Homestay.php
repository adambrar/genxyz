<?php
/**
 *
 * Homestay class extends Member for members offering homestay
 *
 */

class Homestay extends Member {
    
    private static $db = array(
        'Country' => 'Varchar(100)',
        'City' => 'Varchar(100)'
    );
    
}