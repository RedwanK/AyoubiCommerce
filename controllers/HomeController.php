<?php

namespace App\Controller;

use App\Entity\Products;
use App\Models\ProductsDAO;
use App\Models\CategoryDAO;

require_once 'AbstractController.php';
require_once PATH_MODELS . 'ProductsDAO.php';
require_once PATH_MODELS . 'CategoryDAO.php';
require_once PATH_ENTITY . 'Products.php';

class HomeController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show() {
        $productsDAO = new ProductsDAO();
        $categoryDAO = new CategoryDAO();

        $products = $productsDAO->getAllProducts();
        $categories = $categoryDAO->getAllCategories();

        echo $this->twig->render('Home/index.html.twig', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
