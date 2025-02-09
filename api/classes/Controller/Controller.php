<?php
declare(strict_types = 1);

namespace Api\Classes\Controller;

use Illuminate\Database\Capsule\Manager as Capsule;

trait Controller {
    protected array $ret;

    public static function getInstance(): static {
        session_start();

        $capsule = new Capsule;

        // Set up the database connection for Eloquent models
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'mysql', 
            'database'  => 'tests',
            'username'  => 'test',
            'password'  => '04dffEGRR!',
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix'    => '',
        ]);

        // Set the Capsule instance as globally accessible
        $capsule->setAsGlobal();

        // Boot Eloquent ORM (theoretically optional, but required to use Eloquent's features like relationships, etc.)
        $capsule->bootEloquent();

        return new static();
    }

    public function outputResult(): void {
        header('Content-Type: application/json');

        echo json_encode($this->ret);
    }
}