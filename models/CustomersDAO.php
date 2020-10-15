<?php
namespace App\Models;

require_once PATH_ENTITY . 'Customers.php';
require_once 'DAO.php';
require_once 'CustomersStructure.php';
class CustomersDAO extends DAO
{
    public function getCustomerByKeySecret($log)
    {
        $requete = "SELECT * FROM Customers WHERE key_secret = ?";
        $donnees = array($log);
        $res = $this->queryRow($requete, $donnees);

        if ($res) {
            return new \App\Entity\Customers($res[CustomersStructure::ID], $res[CustomersStructure::FIRSTNAME], $res[CustomersStructure::FAMILYNAME], $res[CustomersStructure::ADDRESS], $res[CustomersStructure::USERNAME], $res[CustomersStructure::PASSWORD], $res[CustomersStructure::KEY_SECRET]);
        } else {
            return null;
        }

    }

    public function getCustomerByUsername($username)
    {
        $requete = "SELECT * FROM Customers WHERE username = ?";
        $donnees = array($username);
        $res = $this->queryRow($requete, $donnees);

        if ($res) {
            return new \App\Entity\Customers($res[CustomersStructure::ID], $res[CustomersStructure::FIRSTNAME], $res[CustomersStructure::FAMILYNAME], $res[CustomersStructure::ADDRESS], $res[CustomersStructure::USERNAME], $res[CustomersStructure::PASSWORD], $res[CustomersStructure::KEY_SECRET]);
        } else {
            return false;
        }

    }
}
