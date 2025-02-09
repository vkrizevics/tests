<?php
declare(strict_types = 1);

require '../vendor/autoload.php';

use Api\Classes\Controller\TestQuestions;

$testId = $_GET['test'] ?? 0;

TestQuestions::getInstance()
    ->getCurrentQuestion((int)$testId)
    ->outputResult();
