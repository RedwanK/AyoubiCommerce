<?php
namespace App\Models;

use App\Entity\Customers;

require_once PATH_ENTITY . 'Customers.php';
require_once 'DAO.php';
require_once 'CustomersStructure.php';
class CustomersDAO extends DAO
{
    protected $entityName = 'customers';
    public function getCustomerByKeySecret($log)
    {
        $requete = "SELECT * FROM Customers WHERE " . CustomersStructure::KEY_SECRET . " = ?";
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
        $requete = "SELECT * FROM Customers WHERE " . CustomersStructure::USERNAME . " = ?";
        $donnees = array($username);
        $res = $this->queryRow($requete, $donnees);

        if ($res) {
            return new \App\Entity\Customers($res[CustomersStructure::ID], $res[CustomersStructure::FIRSTNAME], $res[CustomersStructure::FAMILYNAME], $res[CustomersStructure::ADDRESS], $res[CustomersStructure::USERNAME], $res[CustomersStructure::PASSWORD], $res[CustomersStructure::KEY_SECRET]);
        } else {
            return null;
        }
    }

    public function newCustomer($customer)
    {
        $requete = "INSERT INTO Customers(" . CustomersStructure::FIRSTNAME . ", " . CustomersStructure::FAMILYNAME . ", " . CustomersStructure::ADDRESS . ", " . CustomersStructure::USERNAME . ", " . CustomersStructure::PASSWORD . ", " . CustomersStructure::KEY_SECRET. ") VALUES(?, ?, ?, ?, ?, ?)";
        $donnees = array($customer->getFirstname(), $customer->getFamilyname(), $customer->getAddress(), $customer->getUsername(), $customer->getPassword(), $customer->getKeySecret());
        $res = $this->queryInsert($requete, $donnees);
        if ($res == false) {
            return false;
        } else {
            return true;
        }
    }
}
