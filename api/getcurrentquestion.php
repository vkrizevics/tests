<?php
declare(strict_types = 1);

use Api\Classes\Controller\TestQuestions;

require 'classes/Controller/TestQuestions.php';

$testId = $_GET['test'] ?? 0;

TestQuestions::getInstance()
    ->getCurrentQuestion((int)$testId)
    ->outputResult();
