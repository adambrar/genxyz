<?php

class ApplicationFile extends DataExtension {
    private static $has_one = array(
        'SchoolApplication' => 'SchoolApplication'
    );
}