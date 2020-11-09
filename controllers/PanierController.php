<?php

namespace App\Controller;

use App\Models\CustomersDAO;
use App\Models\BasketDAO;

require_once 'AbstractController.php';
require_once 'models/BasketDAO.php';

class PanierController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
        $customersDAO   = new CustomersDAO();
        $basketDAO      = new BasketDAO();
        $customer       = $customersDAO->getCustomerByUsername($_SESSION['customer']['username']);
        $basket         = $basketDAO->getBasketByCustomer($customer->getId());

        echo $this->twig->render('Panier/view.html.twig', ['basket' => $basket]);
    }
}