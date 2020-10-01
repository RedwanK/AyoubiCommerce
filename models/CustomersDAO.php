<?php
require_once PATH_ENTITY . 'Customers.php';
require_once 'DAO.php';
class CustomersDAO extends DAO
{

    public function getCustomersByKeySecret($log)
    {
        $requete = "SELECT * FROM Customerss WHERE key_secret = ?";
        $donnees = array($log);
        $res = $this->queryRow($requete, $donnees);

        if ($res) {
            return new Customers($res['id'], $res['admin'], $res['pseudo'], $res['email'], $res['password'], $res['creation_date'], $res['key_secret']);
        } else {
            return null;
        }

    }

    public function getNbCustomersByEmail($email)
    {
        $requete = "SELECT count(*) as numberEmail FROM Customerss WHERE email = ?";
        $donnees = array($email);
        $res = $this->queryRow($requete, $donnees);

        if ($res) {
            return $res['numberEmail'];
        } else {
            return 0;
        }

    }

    public function getNbCustomersById($id)
    {
        $requete = "SELECT * FROM Customerss WHERE id = ?";
        $donnees = array($id);
        $res = $this->queryRow($requete, $donnees);

        if ($res) {
            return new Customers($res['id'], $res['admin'], $res['pseudo'], $res['email'], $res['password'], $res['creation_date'], $res['key_secret']);
        } else {
            return 0;
        }

    }

    public function getCustomersByEmail($email)
    {
        $requete = "SELECT * FROM Customerss WHERE email = ?";
        $donnees = array($email);
        $res = $this->queryRow($requete, $donnees);

        if ($res) {
            return new Customers($res['id'], $res['admin'], $res['pseudo'], $res['email'], $res['password'], $res['creation_date'], $res['key_secret']);
        } else {
            return null;
        }

    }
}
