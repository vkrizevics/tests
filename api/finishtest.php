<?php
require '../vendor/autoload.php';

use Api\Classes\Controller\Tests;

// Pabeigt testu, ja iesākts - POST dati nav nepieciešami, viss ir sesijā
Tests::getInstance()
    ->finishCurrentTest()
    ->outputResult();