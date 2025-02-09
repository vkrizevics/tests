<?php
declare(strict_types = 1);

namespace Api\Classes\Controller;

use Api\Classes\Model\Test;

class TestQuestions {
    use Controller, PostData;

    public function getCurrentQuestion(): static
    {
        if (isset($_SESSION['currentTest'])) {
            $_SESSION['currentQuestion'] ??= 0;
            $_SESSION['currentQuestion']++;

            // Get the enabled test with the given test ID
            $test = Test::where('id', $_SESSION['currentTest'])
                ->where('enabled', true)
                ->first();

            // Check if the test exists
            if ($test) {
                // Get only id and text for the related questions matching the specific number
                $question = $test->questions()
                    ->where('number', $_SESSION['currentQuestion'])
                    ->select('text', 'number')
                    ->first();
            } else {
                // Handle case where the test doesn't exist or isn't enabled
                $question = null;
            }

            if ($test) {
                if ($question) {
                    $this->ret = [
                        'errorMsg' => '',
                        'currentTest' => $test->id,
                        'question' => $question->text,
                        // Lai lietotājs nebrīnītos par nepareiziem jautājumu numuriem, ja kas
                        'questionCurrentNumber' => (int)$_SESSION['currentQuestion'],
                        'questionTotalCount' => $test->questions()->count(),
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
                        'errorMsg' => 'Nav šāda jautājuma',
                        'currentTest' => $test->id,
                        'question' => '',
                        'questionCurrentNumber' => (int)$_SESSION['currentQuestion'],
                        'questionTotalCount' => $test->questions()->count(),
                        'answers' => [],
                    ];
                }
            } else {
                $this->ret = [
                    'errorMsg' => 'Nav šāda testa',
                    'currentTest' => null,
                    'question' => '',
                    'answers' => [],
                ];
            }
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

    public function submitAnswer(): static 
    {
        $this->readPostData();
        $answerId = (int)$this->getPostData('answer', 0);

        if ($answerId > 0) {
            $this->ret = [
                'errorMsg' => '',
            ];
        } else {
            $this->ret = [
                'errorMsg' => 'Nav šādas atbildes',
            ];
        }

        return $this;
    }
}