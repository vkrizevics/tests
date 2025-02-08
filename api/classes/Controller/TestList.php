<?php
declare(strict_types = 1);

namespace Api\Classes\Controller;

class TestList {
    public static function getTests()
    {
        header('Content-Type: application/json');

        echo json_encode([
            ['id' => 1, 'name' => 'Matemātikā'],
            ['id' => 2, 'name' => 'Bioloģijā'],
            ['id' => 3, 'name' => 'Fizikā'],
        ]);
    }
}