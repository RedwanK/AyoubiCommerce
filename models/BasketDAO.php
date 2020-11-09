<?php
namespace App\Models;

use App\Entity\Basket;

require_once PATH_ENTITY . 'Basket.php';
require_once 'DAO.php';
require_once 'BasketStructure.php';
class BasketDAO extends DAO
{
    protected $entityName = 'basket';
    public function addBasket($basket)
    {
        $requete = "INSERT INTO Basket(" . BasketStructure::CUSTOMER . ", " . BasketStructure::PRODUCT . ", " . BasketStructure::QUANTITY. ") VALUES(?, ?, ?)";
        $donnees = array($basket->getCustomer(), $basket->getProduct(), $basket->getQuantity());
        $res = $this->queryInsert($requete, $donnees);
        if ($res == false) {
            return false;
        } else {
            return true;
        }
    }

    public function updateBasket($basket)
    {
        $requete = "UPDATE Basket SET " . BasketStructure::QUANTITY. " = ? WHERE " . BasketStructure::CUSTOMER . " = ? and " . BasketStructure::PRODUCT . " = ?";
        $donnees = array($basket->getQuantity(), $basket->getCustomer(), $basket->getProduct());
        $res = $this->queryInsert($requete, $donnees);
        if ($res == false) {
            return false;
        } else {
            return true;
        }
    }

    public function getBasket($basket)
    {
        $requete = "SELECT * FROM Basket WHERE " . BasketStructure::CUSTOMER . " = ? and " . BasketStructure::PRODUCT . " = ?";
        $donnees = array($basket->getCustomer(), $basket->getProduct());
        $res = $this->queryRow($requete, $donnees);

        if ($res) {
            return new Basket($res[BasketStructure::CUSTOMER], $res[BasketStructure::PRODUCT], $res[BasketStructure::QUANTITY]);
        } else {
            return null;
        }
    }
}
