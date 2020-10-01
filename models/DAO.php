<?php
require_once PATH_MODELS . 'Connexion.php';
abstract class DAO
{

    private $erreur; //stocke les messages d'erreurs associées au PDOException
    private $debug;

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
            $pdos = Connexion::getInstance()->getBdd()->query($sql); // exécution directe
        } else {
            $pdos = Connexion::getInstance()->getBdd()->prepare($sql); // requête préparée
            $pdos->execute($args);
        }
        return $pdos;
    }

    // retourne un tableau 1D avec les données d'un seul enregistrement
    // ou false
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

    //retourne un tableau 2D avec éventuellement plusieurs enregistrements
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
}
