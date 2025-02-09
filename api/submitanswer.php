<?php
declare(strict_types = 1);

require '../vendor/autoload.php';

use Api\Classes\Controller\TestQuestions;

TestQuestions::getInstance()
    ->submitAnswer((int)$answerId)
    ->outputResult();
