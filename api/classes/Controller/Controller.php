<?php
declare(strict_types = 1);

namespace Api\Classes\Controller;

trait Controller {
    protected array $ret;

    public static function getInstance(): static {
        session_start();
        
        return new static();
    }

    public function outputResult(): void {
        header('Content-Type: application/json');

        echo json_encode($this->ret);
    }
}