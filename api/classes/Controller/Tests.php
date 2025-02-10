<?php
namespace Api\Classes\Controller;

use Api\Classes\Model\Test;
use Api\Classes\Model\User;

/**
 * Kontrolleris, kas nodrošina testu izvēli, uzsākšanu un pabeigšanu
 */
class Tests {
    use Controller, GetTest, PostData;

    /**
     * Izvadīt visu iespējoto testu sarakstu
     * 
     * @return $this
     */
    public function getTests(): static
    {
        $this->ret = Test::where('enabled', true)
            ->get(['id', 'name'])
            ->toArray();

        return $this;
    }

    /**
     * Uzsākt testu un piereģistrēt lietotāju, ja vajag
     * 
     * @return $this
     */
    public function startTest(): static 
    {
        $this->readPostData(); // ielasam POST datus no React

        $_SESSION['userName'] = $this->getPostData('name', '');
        $_SESSION['currentTest'] = $this->getPostData('test', null);
        $_SESSION['currentQuestion'] = 1;
        $_SESSION['rightAnswers'] = 0;

        $errorMsg = '';

        if ($_SESSION['userName'] === '') {
            $errorMsg = 'Nav ievādīts testējamā vārds';
        } else {
            if ($this->getTest($_SESSION['currentTest'])) {
                $user = User::firstOrCreate(['name' => $_SESSION['userName']]);
                
                $_SESSION['userId'] = $user->id;
            } else {
                $errorMsg = 'Nav šāda testa';  
            }
        }

        $this->ret = [
            'errorMsg' => $errorMsg
        ];

        return $this;
    }

    /**
     * Izvadīt gala rezultātu testa pabeigšanas skatam
     * 
     * @return $this
     */
    public function finishCurrentTest(): static
    {
        $errorMsg = '';

        if (isset($_SESSION['currentTest'])) {
            $test = $this->getTest($_SESSION['currentTest']);

            if ($test) {
                if (isset($_SESSION['currentQuestion'])) {
                    $questionCount = $test->questions()->count();
                    
                    if ($questionCount < $_SESSION['currentQuestion']) {   
                        $this->ret = [
                            'errorMsg' => '',
                            'answersRight' => $_SESSION['rightAnswers'] ?? 0,
                            'questionTotalCount' => $questionCount,
                            'userName' => $_SESSION['userName'] ?? '',
                        ];

                        // Atgriezt jēgpilnus datus, ja viss ir kārtībā
                        return $this;
                    } else {
                        $errorMsg = 'Tests nav iziets līdz galam';
                    }
                } else {
                    $errorMsg = 'Tests nav uzsākts';
                }
            } else {
                $errorMsg = 'Neesošs tests';    
            }
        } else {
            $errorMsg = 'Tests nav uzsākts';
        }

        // Citādi atgriezt kādu no kļūdas paziņojumiem
        $this->ret = [
            'errorMsg' => $errorMsg
        ];

        return $this;
    }
}