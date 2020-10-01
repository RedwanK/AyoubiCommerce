<?php
// Implémente le pattern Singleton
class Connexion
{
    private $bdd = null;
    private static $instance = null;

    //appelée par new
    private function __construct()
    {
        $this->bdd = new PDO('mysql:host=' . BD_HOST . '; dbname=' . BD_DBNAME . '; charset=utf8', BD_USER, BD_PWD);
        $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //appelée par clone
    private function __clone()
    {
    }

    //appelée par unserialize
    private function __wakeup()
    {
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Connexion();
        }

        return self::$instance;
    }

    public function getBdd()
    {
        return $this->bdd;
    }

}
