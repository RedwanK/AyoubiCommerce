<?php
namespace App\Entity;

class Basket
{
    private $customer;

    private $product;

    private $quantity;

    public function __construct($customer, $product, $quantity)
    {
        $this->customer = $customer;
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product)
    {
        $this->product = $product;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}
