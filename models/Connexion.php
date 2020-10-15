<?php
namespace App\Models;

class Connexion
{
    private $bdd = null;
    private static $instance = null;

    private function __construct()
    {
        $this->bdd = new \PDO('mysql:host=' . BD_HOST . '; dbname=' . BD_DBNAME . '; charset=utf8', BD_USER, BD_PWD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new \App\Models\Connexion();
        }

        return self::$instance;
    }

    public function getBdd()
    {
        return $this->bdd;
    }

}
