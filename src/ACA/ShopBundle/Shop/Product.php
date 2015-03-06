<?php

namespace ACA\ShopBundle\Shop;

use \Exception as Exception;

class Product
{
    /**
     * Database connection
     *
     * @var DBCommon
     */
    protected $db;

    /**
     * Unique numeric product identifier
     *
     * @var int
     */
    protected $productId;

    /**
     * Name of this product
     *
     * @var string
     */
    protected $name;

    /**
     * Description for product
     *
     * @var string
     */
    protected $description;

    /**
     * Image URL
     *
     * @var string
     */
    protected $image;

    /**
     * Category this product is in
     *
     * @var string
     */
    protected $category;

    /**
     * Price
     *
     * @var float
     */
    protected $price;

    /**
     * This is the quantity the user wants
     * @var int
     */
    protected $quantity = 1;




    public function __construct($productId)
    {
        $this->productId = $productId;
    }

    /**
     * Load one product from the database and hydrate local properties with data
     *
     * @throws Exception
     * @return bool
     */
    public function load()
    {
        $query
            = '
        select
            *
        from
            aca_product
        where
            product_id = "' . $this->productId . '"';

        $this->db->setQuery($query);
        $productObj = $this->db->loadObject();

        if (!empty($productObj)) {

            $this->name = $productObj->name;
            $this->description = $productObj->description;
            $this->image = $productObj->image;
            $this->category = $productObj->category;
            $this->price = $productObj->price;

            return true;
        }
        return false;
    }

    /**
     * @param DBCommon $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price * $this->quantity;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

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
}