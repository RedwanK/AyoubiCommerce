<?php
namespace App\Models;

use App\Entity\Category;

require_once PATH_ENTITY . 'Category.php';
require_once 'DAO.php';
require_once 'CategoryStructure.php';

class CategoryDAO extends DAO
{
    protected $entityName = "Category";
    public function getAllCategories()
    {
        $requete = "SELECT * FROM Category ORDER BY name DESC";
        $donnees = [];
        $res = $this->queryAll($requete, $donnees);
        if ($res) {
            $categories = [];
            foreach ($res as $c) {
                $categories[] = new Category($c[CategoryStructure::ID], $c[CategoryStructure::NAME], $c[CategoryStructure::SLUG]);
            }
            return $categories;
        } else {
            return null;
        }

    }

    /**
     * @param string $field
     * @param string $value
     *
     * @return Category|array
     */
    public function findOneBy(string $field, string $value)
    {
        $categoryArray = parent::findBy($field, $value)[0];
        return new Category($categoryArray[CategoryStructure::ID], $categoryArray[CategoryStructure::NAME], $categoryArray[CategoryStructure::SLUG]);
    }
}
