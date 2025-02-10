<?php
require '../vendor/autoload.php';

use Api\Classes\Controller\Tests;

// Izvadīt visu iespējotu testu sarakstu - ievaddati nav nepieciešami, viss ir datubāzē
Tests::getInstance()
    ->getTests()
    ->outputResult();
