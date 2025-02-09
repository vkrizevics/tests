<?php
declare(strict_types = 1);

require '../vendor/autoload.php';

use Api\Classes\Controller\TestList;

TestList::getInstance()
    ->getTests()
    ->outputResult();
