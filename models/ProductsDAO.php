<?php
namespace App\Models;

require_once PATH_ENTITY . 'Products.php';
require_once 'DAO.php';

class ProductsDAO extends DAO
{
    protected $entityName = "Products";
}
