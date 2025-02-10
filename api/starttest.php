<?php
require '../vendor/autoload.php';

use Api\Classes\Controller\Tests;

Tests::getInstance()
    ->readPostData()
    ->startTest()
    ->outputResult();