<?php
declare(strict_types = 1);

namespace Api\Classes\Controller;

require 'Controller.php';

class TestQuestions {
    use Controller;

    public function getCurrentQuestion(): static
    {
            if (isset($_SESSION['currentTest'])) {
                $_SESSION['currentQuestion'] ??= 0;
                $_SESSION['currentQuestion']++;

                $this->ret = [
                    'errorMsg' => '',
                    'currentTest' => (int)$_SESSION['currentTest'],
                    'question' => 'Cik būs 2 x 2?',
                    'questionCurrentNumber' => 1,
                    'questionTotalCount' => 3,
                    'answers' => [
                        ['id' => 1, 'text' => '1'],
                        ['id' => 2, 'text' => '2'],
                        ['id' => 3, 'text' => '3'],
                        ['id' => 4, 'text' => '4'],
                        ['id' => 5, 'text' => '5'],
                        ['id' => 6, 'text' => '6'],
                    ],
                ];
            } else {
                $this->ret = [
                    'errorMsg' => 'Nav šāda testa',
                    'currentTest' => null,
                    'question' => '',
                    'answers' => [],
                ];
            }
            

        return $this;
    }
}