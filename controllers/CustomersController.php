<?php

namespace App\Controller;

require_once 'AbstractController.php';
require_once PATH_MODELS . 'CustomersDAO.php';
require_once PATH_ENTITY . 'Customers.php';

class CustomersController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Connection page
     */
    public function connexion()
    {
        $customersDAO = new CustomersDAO();

        /* Check if cookie exist */
        if (!empty($_COOKIE['log']) && !isset($_SESSION['connect'])) {
            $log = htmlspecialchars($_COOKIE['log']);

            $customer = $customersDAO->getCustomerByKeySecret($log);
            if ($customer) {
                /* Connect customer */
                $_SESSION['connect'] = 1;

                /* Redirect to home */
                header('location: ../');
                exit();
            }
        }

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            /* Hash password */
            $password = md5($password);

            $customer = $customersDAO->getCustomerByUsername($username);

            if ($customer && $password == $customer->getPassword()) {
                /* Connect customer */
                $_SESSION['connect'] = 1;

                /* Create cookie */
                if (isset($_POST['check_connect'])) {
                    setcookie(
                        'log',
                        $customer->getKeySecret(),
                        time() + 365 * 24 * 3600,
                        null,
                        null,
                        false,
                        true
                    );
                }

                /* Redirect to home */
                header('location: ../');
                exit();
            }

            header('location: ../connexion?error=INCONNUE&email=' . $email);
            exit();

        }

        $email = null;
        $alert = null;

        if (isset($_GET['email'])) {
            $email = htmlspecialchars($_GET['email']);
        }

        /* Check if error exist */
        if (isset($_GET['error'])) {
            $message = htmlspecialchars($_GET['error']);
            $alert = choixAlert($message);
        }

        echo $this->twig->render('connexion.html', [
            'email' => $email,
            'alert' => $alert,
        ]);
    }

    /**
     * Disconnection page
     */
    public function deconnexion()
    {
        /* Initialize the session */
        session_start();
        /* Desactivate the session */
        session_unset();
        /* Destroy the session */
        session_destroy();
        /* Destroy the cookie : remove x secondes to time */
        setcookie(
            'log', 
            '', 
            time() - 3444,
            null, 
            null, 
            false, 
            true
        );

        /* Redirect to home */
        header('location: ../');
        exit();
    }
}
