<?php

namespace App\Controller;

use App\Models\CustomersDAO;
use App\Models\BasketDAO;
use App\Models\ProductsDAO;

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
        $productDAO     = new ProductsDAO();
//        if ($_SESSION['customer']) {
            $customer   = $customersDAO->getCustomerByUsername($_SESSION['customer']['username']);
//        } else {
//            echo $this->twig->render('Panier/view.html.twig');
//            //panier si non connecté
//        }
        $basket         = $basketDAO->getBasketByCustomer((int)$customer->getId());
        $products       = [];
        if ($basket and $customer) {
            foreach ($basket as $product) {
                $products[] = ['produit' => array_merge(...$productDAO->findBy('id', (int)$product->getProduct())), 'quantite' => $product->getQuantity()];
            }
        }

        echo $this->twig->render('Panier/view.html.twig', [
            'products' => $products,
            'basket'   => $basket
        ]);
        return;
    }
}