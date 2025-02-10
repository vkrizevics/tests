<?php
namespace Api\Classes\Controller;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Traits, kas nodrošina kontrolleru saikni ar datubāzi un ievaddatiem no pieprasījumiem 
 */

trait Controller {
    /**
     * Tiek izvadīts kā JSON priekš React AJAX pieprasījumiem
     * 
     * @array 
     */
    protected array $ret = [];

    /**
     * Inicializē kontrolleri ar plūstošo interfeisu
     * 
     * @return $this
     */
    public static function getInstance(): static {
        session_start();

        $capsule = new Capsule;

        // Datubāzes konfigurācija
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

        // Kapsula būs globāli sasniedzama
        $capsule->setAsGlobal();

        // Startējam Eloquent lai pilnvērtīgi izmantotu tā ORM
        $capsule->bootEloquent();

        return new static();
    }

    /**
     * Izvada JSON priekš React
     */
    public function outputResult(): void {
        header('Content-Type: application/json');

        echo json_encode($this->ret);
    }
}