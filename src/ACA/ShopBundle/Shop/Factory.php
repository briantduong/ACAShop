<?php

namespace ACA\ShopBundle\Shop;

/**
 * This class is responsible for instantiating objects for us
 * Class ShopFactory
 *
 * @package ACA\ShopBundle\Util
 */
class Factory
{
    /**
     * @var DBCommon
     */
    protected $db;

    /**
     * @param DBCommon $db Database connection injected via service container
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Get all products
     *
     * @return Product[]
     */
    public function getAllProducts()
    {
        /** @var Product[] $Products */
        $Products = [];

        $query = 'select product_id from aca_product';

        $this->db->setQuery($query);

        $productIdRows = $this->db->loadObjectList();

        foreach ($productIdRows as $productIdRow) {

            $Product = new Product($productIdRow->product_id);
            $Product->setDb($this->db);
            $Product->load();

            array_push($Products, $Product);
        }
        return $Products;
    }

    /**
     * @param array $productIds Array of all productIds to get
     *
     * @return Product[]
     */
    public function getSomeProducts($productIds)
    {
        /** @var Product[] $Products */
        $Products = [];
        $temp = array();

        foreach ($productIds as $cartItem)
        {
            $temp[] = $cartItem['productId'];
        }


        $query = 'select product_id from aca_product where product_id in(' . implode(',', $temp) . ')';

        $this->db->setQuery($query);

        $productIdRows = $this->db->loadObjectList();

        foreach ($productIdRows as $productIdRow) {

            $Product = new Product($productIdRow->product_id);
            $Product->setDb($this->db);
            $Product->load();

            array_push($Products, $Product);
        }
        return $Products;
    }
}
