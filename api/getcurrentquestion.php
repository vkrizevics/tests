<?php
require '../vendor/autoload.php';

use Api\Classes\Controller\TestQuestions;

// Izvadīt kārtējo jautājumu ar atbildēm - POST dati nav nepieciešami, viss ir sesijā
TestQuestions::getInstance()
    ->getCurrentQuestion()
    ->outputResult();
