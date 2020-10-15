<?php
namespace App\Entity;

class Customers
{
    private $id;

    private $firstname;

    private $familyname;

    private $address;

    private $username;

    private $password;

    private $keySecret;

    public function __construct($id, $firstname, $familyname, $address, $username, $password, $keySecret)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->familyname = $familyname;
        $this->address = $address;
        $this->username = $username;
        $this->password = $password;
        $this->keySecret = $keySecret;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getFamilyname()
    {
        return $this->familyname;
    }

    public function setFamilyname($familyname)
    {
        $this->familyname = $familyname;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getKeySecret()
    {
        return $this->keySecret;
    }

    public function setKeySecret($keySecret)
    {
        $this->keySecret = $keySecret;
    }
}
