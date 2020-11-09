<?php
namespace App\Models;

use App\Entity\Products;

require_once PATH_ENTITY . 'Products.php';
require_once 'DAO.php';
require_once 'ProductsStructure.php';
require_once 'CategoryStructure.php';

class ProductsDAO extends DAO
{
    protected $entityName = "products";
    public function getAllProducts()
    {
        $requete = "SELECT * FROM Products ORDER BY price DESC";
        $donnees = [];
        $res = $this->queryAll($requete, $donnees);
        $categoryDAO = new CategoryDAO();
        if ($res) {
            $products = [];
            foreach ($res as $p) {
                $category = $categoryDAO->findOneBy(CategoryStructure::SLUG, $p[ProductsStructure::CATEGORY]);
                $products[] = new Products($p[ProductsStructure::ID], $p[ProductsStructure::NAME], $p[ProductsStructure::DESCRIPTION], $p[ProductsStructure::PRICE], $p[ProductsStructure::SLUG], $category);
            }
            return $products;
        } else {
            return null;
        }

    }

    public function getProductBySlug($slug)
    {
        $requete = "SELECT * FROM Products WHERE " . ProductsStructure::SLUG . " = ?";
        $donnees = array($slug);
        $res = $this->queryRow($requete, $donnees);

        if ($res) {
            return new Products($res[ProductsStructure::ID], $res[ProductsStructure::NAME], $res[ProductsStructure::DESCRIPTION], $res[ProductsStructure::PRICE], $res[ProductsStructure::SLUG]);
        } else {
            return null;
        }
    }
}
