<?php
require '../vendor/autoload.php';

use Api\Classes\Controller\TestQuestions;

TestQuestions::getInstance()
    ->submitAnswer()
    ->outputResult();
