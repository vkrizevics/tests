<?php
namespace Api\Classes\Controller;

use Api\Classes\Model\AnswerLog;
use Api\Classes\Model\RightAnswer;
use Api\Classes\Model\Test;
use Api\Classes\Model\TestResult;

/**
 * Kontrolleris jautājumu uzdošanai un atbilžu reģistrācijai
 * Piefiksē arī testa gala rezultātu, reģistrējot pēdējo atbildi - 
 * lai rezultātu skatu varētu pārlādēt cik vien tīk
 */
class TestQuestions {
    use Controller, GetTest, PostData;

    /**
     * Atgriež kārtējo jautājumu un atbildes
     * 
     * @return $this
     */
    public function getCurrentQuestion(): static
    {
        if (isset($_SESSION['currentTest'])) {
            $_SESSION['currentQuestion'] ??= 1;

            $test = $this->getTest($_SESSION['currentTest']);

            // Ja lietotāja uzsāktais test ir atrodāms datubāzē
            if ($test) {
                /*
                 * Atrast kārtējo jautājumu pēc kartas, lai nemaldinātu lietotāju, 
                 * paļaujoties uz numuriem, kas varētu būt neprecīzi
                 */
                $question = $test->questions()
                    ->skip($_SESSION['currentQuestion'] - 1)
                    ->take(1)
                    ->select('id', 'text', 'number')
                    ->first();
                
                if ($question) {
                    $answersToRandomize = $question->answers()
                        ->select('id', 'text')
                        ->get()
                        ->toArray();
                    shuffle($answersToRandomize); // pārkārtot atbildes nejaušā secībā
                    $answers = array_values($answersToRandomize);
                } else {
                    $answers = [];
                }
            } else {
                // Ja testa nav, nebūs nedz jautājuma, nedz atbilžu
                $question = null;
                $answers = [];
            }

            if ($test) {
                $errorMsg = '';
                $questionText = '';
                
                // Korektam jautājumam jābūt vismaz 2 atbildēm, lai to varētu uzdot lietotājam
                if ($question) {
                    if (count($answers) >= 2) {
                        $questionText = $question->text;
                    } else {
                        $errorMsg = 'Nepareizs atbilžu skaits'; 
                    }
                } else {
                    $errorMsg = 'Nav šāda jautājuma';
                }

                $this->ret = [
                    'errorMsg' => $errorMsg,
                    'currentTest' => $test->id,
                    'question' => $questionText,
                    
                    // Lai lietotājs nebrīnītos par nepareiziem jautājumu numuriem, ja kas
                    'questionCurrentNumber' => (int)$_SESSION['currentQuestion'],
                    'questionTotalCount' => $test->questions()->count(),
                    'answers' => $answers,
                ];
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

    /**
     * Piefiksē doto atbildi, pārtin jautājumu uz priekšu
     * 
     * @return $this
     */
    public function submitAnswer(): static 
    {
        $this->readPostData(); // ielasam POST datus no React
        
        $answerId = (int)$this->getPostData('answer', 0);

        $errorMsg = '';

        if ($answerId > 0) {
            $test = Test::where('id', $_SESSION['currentTest'])
                ->where('enabled', true)
                ->first();

            if ($test) {
                $questionId = $test->questions()
                    ->skip($_SESSION['currentQuestion'] - 1)
                    ->take(1)
                    ->pluck('id')
                    ->first();
                
                if ($questionId) {
                    // Ja atbilde ir pareiza un dati derīgi, uzlabojam gala rezultātu sesijā, lai atslogotu datubāzi
                    $rightAnswerId = RightAnswer::where('question_id', $questionId)
                        ->pluck('answer_id')
                        ->first();

                    $_SESSION['rightAnswers'] ??= 0;
                    if ($answerId === $rightAnswerId) {
                        $_SESSION['rightAnswers']++;
                    }
                    
                    $questionCount = $test->questions()->count();

                    if ($questionCount <= $_SESSION['currentQuestion']) {    
                        /*
                         * Visi jautājumi ir veiksmīgi izieti, laiks piefiksēt gala rezultātu 
                         * šajā metodē, lai varētu pārladēt rezultātu skatu bez blakus efektiem
                         */ 
                        $result = new TestResult();

                        $result->user_id = $_SESSION['userId'];
                        $result->test_id = $_SESSION['currentTest'];
                        $result->right_answers = $_SESSION['rightAnswers'];

                        $result->save();
                    }
                } else {
                    $errorMsg = 'Nav šāda jautājuma';
                }
            } else {
                $questionId = null;
                
                $errorMsg = 'Nav šāda testa';
            }

            // Jebkurā gadījuma, ja vien atbilde pastāv, logojam to
            $log = new AnswerLog();

            $log->user_id = $_SESSION['userId'];
            $log->test_id = $_SESSION['currentTest'] ?? 0;
            $log->question_id = $questionId;
            $log->answer_id = $answerId;

            $log->save();

            $_SESSION['currentQuestion']++;
        } else {
            $errorMsg = 'Nav šādas atbildes';
        }

        $this->ret = [
            'errorMsg' => $errorMsg,
        ];

        return $this;
    }
}