<?php
require_once PATH_ENTITY . 'Customers.php';
require_once 'DAO.php';
require_once 'CustomersStructure.php';
class CustomersDAO extends DAO
{
    public function getCustomersByKeySecret($log)
    {
        $requete = "SELECT * FROM Customers WHERE key_secret = ?";
        $donnees = array($log);
        $res = $this->queryRow($requete, $donnees);

        if ($res) {
            return new Customers($res[CustomersStructure::ID], $res[CustomersStructure::FIRSTNAME], $res[CustomersStructure::FAMILYNAME], $res[CustomersStructure::ADDRESS], $res[CustomersStructure::USERNAME], $res[CustomersStructure::PASSWORD], $res[CustomersStructure::KEY_SECRET]);
        } else {
            return null;
        }

    }

    public function getCustomersById($id)
    {
        $requete = "SELECT * FROM Customers WHERE id = ?";
        $donnees = array($id);
        $res = $this->queryRow($requete, $donnees);

        if ($res) {
            return new Customers($res[CustomersStructure::ID], $res[CustomersStructure::FIRSTNAME], $res[CustomersStructure::FAMILYNAME], $res[CustomersStructure::ADDRESS], $res[CustomersStructure::USERNAME], $res[CustomersStructure::PASSWORD], $res[CustomersStructure::KEY_SECRET]);
        } else {
            return false;
        }

    }
}
