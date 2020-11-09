<?php
namespace App\Models;

require_once PATH_MODELS . 'Connexion.php';
abstract class DAO
{

    private $erreur; //stocke les messages d'erreurs associées au PDOException
    private $debug;
    protected $entityName;

    public function getErreur()
    {
        return $this->erreur;
    }

    public function getLastID()
    {
        return Connexion::getInstance()->getBdd()->lastInsertId();
    }

    private function requete($sql, $args = null)
    {
        if ($args == null) {
            $pdos = Connexion::getInstance()->getBdd()->query($sql); // direct exect
        } else {
            $pdos = Connexion::getInstance()->getBdd()->prepare($sql); // prepared exec (with args)
            $pdos->execute($args);
        }
        return $pdos;
    }

    // return a single element | false
    public function queryRow($sql, $args = null)
    {
        try
        {
            $pdos = $this->requete($sql, $args);
            $res = $pdos->fetch();
            $pdos->closeCursor();
        } catch (PDOException $e) {
            if ($this->debug) {
                die($e->getMessage());
            }

            $this->erreur = 'query';
            $res = false;
        }
        return $res;
    }

    //return all lines
    public function queryAll($sql, $args = null)
    {
        try
        {
            $pdos = $this->requete($sql, $args);
            $res = $pdos->fetchAll();
            $pdos->closeCursor();
        } catch (PDOException $e) {
            if ($this->debug) {
                die($e->getMessage());
            }

            $this->erreur = 'query';
            $res = false;
        }
        return $res;
    }

    // insert
    public function queryInsert($sql, $args = null)
    {
        try
        {
            $pdos = $this->requete($sql, $args);
            $res = true;
        } catch (PDOException $e) {
            if ($this->debug) {
                die($e->getMessage());
            }

            $this->erreur = 'query';
            $res = false;
        }
        return $res;
    }

    public function findBy(string $field, string $value): array
    {
        $request = "SELECT * FROM $this->entityName WHERE $field = '$value'";
        try {
            $pdos = $this->requete($request);
            $res = $pdos->fetchAll();
        } catch (PDOException $e) {
            $this->erreur = 'query';
            $res = false;
        }
        return $res;
    }
}
