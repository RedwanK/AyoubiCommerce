<?php

namespace App\Controller;

use App\Entity\Basket;
use App\Entity\Products;
use App\Entity\Customers;
use App\Models\BasketDAO;
use App\Models\ProductsDAO;
use App\Models\CustomersDAO;

require_once 'AbstractController.php';
require_once PATH_MODELS . 'ProductsDAO.php';
require_once PATH_MODELS . 'CustomersDAO.php';
require_once PATH_MODELS . 'BasketDAO.php';
require_once PATH_ENTITY . 'Products.php';
require_once PATH_ENTITY . 'Customers.php';
require_once PATH_ENTITY . 'Basket.php';

class BasketController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add() {
        $this->addToBasket(false);
    }

    public function addApi() {
        $this->addToBasket(true);
    }

    public function view()
    {
        $customersDAO   = new CustomersDAO();
        $basketDAO      = new BasketDAO();
        $productDAO     = new ProductsDAO();
        $customer       = null;
        $basket         = null;
        $products       = [];

        if (array_key_exists('customer', $_SESSION)) {
            $customer   = $customersDAO->getCustomerByUsername($_SESSION['customer']['username']);
            $basket     = $basketDAO->getBasketByCustomer((int)$customer->getId());
        }

        if ($basket) {
            foreach ($basket as $product) {
                $products[] = [
                    'produit' =>
                        array_merge(...$productDAO->findBy('id', (int)$product->getProduct())),
                    'quantite' =>
                        $product->getQuantity()
                ];
            }
        } else if (!$customer){ //else à garder mais if !customer à supprimer quand le panier anonyme sera géré
            header('location: ../?message=ERROR_BASKET_VIEW');
        }

        echo $this->twig->render('Panier/view.html.twig', [
            'products' => $products,
            'basket'   => $basket
        ]);
        return;
    }

    private function addToBasket($api)
    {
        $productsDAO  = new ProductsDAO();
        $customersDAO = new CustomersDAO();
        $basketDAO    = new BasketDAO();

        $slug         = null;
        $quantity     = null;
        $username     = null;

        if (!empty($_POST['slug']) &&
            !empty($_POST['quantity']) &&
            isset($_SESSION['customer'])) {
            $slug     = htmlspecialchars($_POST['slug']);
            $quantity = htmlspecialchars($_POST['quantity']);
            $username = $_SESSION['customer']['username'];

            /* Check if customer/product exist and quantity is correct */
            $customer = $customersDAO->getCustomerByUsername($username);
            $product  = $productsDAO->getProductBySlug($slug);
            if (!$customer || !$product || $quantity < 1) {
                if ($api) {
                    echo json_encode([
                        'message' => MESSAGE_ERROR_BASKET,
                        'color' => 'red'
                    ]);
                } else {
                    header('location: ../?message=ERROR_BASKET');
                }
                exit();
            }

            $basket = new Basket($customer->getId(), $product->getId(), $quantity);

            /* Check if basket is already in db */
            $tmp = $basketDAO->getBasket($basket);
            if (!$tmp) {
                $res = $basketDAO->addBasket($basket);
            } else {
                $basket->setQuantity($basket->getQuantity() + $tmp->getQuantity());
                $res = $basketDAO->updateBasket($basket);
            }

            if (!$res) {
                if ($api) {
                    echo json_encode([
                        'message' => MESSAGE_ERROR_BASKET,
                        'color' => 'red'
                    ]);
                } else {
                    header('location: ../?message=ERROR_BASKET');
                }
                exit();
            } /* Error case */

            /* No error */
            if ($api) {
                echo json_encode([
                    'message' => MESSAGE_ADD_BASKET,
                    'color' => 'green'
                ]);
            } else {
                header('location: ../?message=ERROR_BASKET');
            }
            exit();
        }
        if ($api) {
            echo json_encode([
                'message' => MESSAGE_ERROR_BASKET,
                'color' => 'red'
            ]);
        } else {
            header('location: ../?message=ERROR_BASKET');
        }
    }
}
