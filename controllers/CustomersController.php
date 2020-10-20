<?php

namespace App\Controller;

use App\Entity\Customers;
use App\Models\CustomersDAO;

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

        $username = null;
        $alert = null;

        /* Check if cookie exist */
        if (!empty($_COOKIE['log']) && !isset($_SESSION['connect'])) {
            $log = htmlspecialchars($_COOKIE['log']);

            $customer = $customersDAO->getCustomerByKeySecret($log);
            if ($customer) {
                /* Connect customer */
                $this->connect($customer);

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
                $this->connect($customer);

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

            header('location: ../connexion?message=INCONNUE&username=' . $username);
            exit();
        }

        /* Check if message exist */
        $alert = checkMessage();

        /* Get parameter in URL */
        $username = getParameter('username');

        echo $this->twig->render('Connexion/connexion.html.twig', [
            'username' => $username,
            'alert' => $alert,
        ]);
    }

    /**
     * Create session variables
     */
    private function connect($customer)
    {
        $_SESSION['connect'] = 1;
        $_SESSION['customer'] = [
            'firstname' => $customer->getFirstname(),
            'familyname' => $customer->getFamilyname(),
            'address' => $customer->getAddress(),
            'username' => $customer->getUsername(),
        ];
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

    /**
     * Add a new customer
     */
    public function register()
    {
        $customersDAO = new CustomersDAO();

        $alert = null;
        $firstname = null;
        $familyname = null;
        $address = null;
        $username = null;

        if (!empty($_POST['firstname']) &&
            !empty($_POST['familyname']) &&
            !empty($_POST['address']) &&
            !empty($_POST['username']) &&
            !empty($_POST['password']) &&
            !empty($_POST['confirmpassword']) &&
            isset($_POST['g-recaptcha-response'])) {
            $firstname = htmlspecialchars($_POST['firstname']);
            $familyname = htmlspecialchars($_POST['familyname']);
            $address = htmlspecialchars($_POST['address']);
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $confirmpassword = htmlspecialchars($_POST['confirmpassword']);
            
            /* Check if username doesnt exist */
            $customer = $customersDAO->getCustomerByUsername($username);
            if ($customer) {
                header('location: ../creer-compte?message=USERNAME_TAKEN&firstname=' . $firstname . '&familyname=' . $familyname . '&address=' . $address . '&username=' . $username);
                exit();
            }

            /* Check passwords are the same */
            if ($password != $confirmpassword) {
                header('location: ../creer-compte?message=PASSWORDS_NOT_SAME&firstname=' . $firstname . '&familyname=' . $familyname . '&address=' . $address . '&username=' . $username);
                exit();
            }

            /* Check captcha */
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . PRIVATE_KEY . '&response=' . $_POST['g-recaptcha-response']);
            $resp = json_decode($verifyResponse);

            if ($resp != null && $resp->success) {
                /* Hash password */
                $password = md5($password);

                /* Create key secret */
                $keySecret = md5(md5(time() . 'chachacha') . $username . time());
            
                $customer = new Customers(
                    null,
                    $firstname,
                    $familyname,
                    $address,
                    $username,
                    $password,
                    $keySecret
                );

                $res = $customersDAO->newCustomer($customer);

                if (!$res) {
                    header('location: ../creer-compte?message=INSERT&firstname=' . $firstname . '&familyname=' . $familyname . '&address=' . $address . '&username=' . $username);
                    exit();
                } /* Error case */

                /* Success case : redirect to connexion page */
                header('location: ../connexion?message=INSERT_SUCCESS&username=' . $username);
                exit();
            } else {
                /* Captcha error */
                header('location: ../creer-compte?message=CAPTCHA&firstname=' . $firstname . '&familyname=' . $familyname . '&address=' . $address . '&username=' . $username);
                exit();
            }
        }

        /* Check if message exist */
        $alert = checkMessage();

        /* Get parameters in URL */
        $firstname = getParameter('firstname');
        $familyname = getParameter('familyname');
        $address = getParameter('address');
        $username = getParameter('username');
        
        echo $this->twig->render('Connexion/register.html.twig', [
            'alert' => $alert,
            'firstname' => $firstname,
            'familyname' => $familyname,
            'address' => $address,
            'username' => $username,
            'siteKey' => PUBLIC_KEY
        ]);
    }
}
