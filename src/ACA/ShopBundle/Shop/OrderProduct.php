<?php

namespace ACA\ShopBundle\Shop;

/**
 * Class OrderProduct repreents a purchased product
 *
 * @package ACA\ShopBundle\Shop
 */
class OrderProduct extends Product
{
    /**
     * Purchased quantity
     *
     * @var int
     */
    protected $quantity;

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float product price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
}