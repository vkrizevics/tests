<?php
require '../vendor/autoload.php';

use Api\Classes\Controller\Tests;

// Uzsākt testu
Tests::getInstance()
    ->startTest()
    ->outputResult();