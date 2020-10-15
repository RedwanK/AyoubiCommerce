<?php

namespace App\Controller;

use App\Entity\Products;
use \ProductsDAO;
use App\Models\CustomersDAO;
require_once('entities/Products.php');

require_once 'AbstractController.php';
require_once 'models/CustomersDAO.php';

class HomeController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show() {
        echo $this->twig->render('Home/index.html.twig', []);
    }
}
