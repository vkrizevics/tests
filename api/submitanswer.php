<?php
require '../vendor/autoload.php';

use Api\Classes\Controller\TestQuestions;

// Iesniegt atbildi jautājumam un pārtīt sesiju uz nākamo jautājumu, ja ir vai arī piefiksēt gala rezultātu datubāzē
TestQuestions::getInstance()
    ->submitAnswer()
    ->outputResult();
