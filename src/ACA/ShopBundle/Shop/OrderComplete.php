<?php

namespace ACA\ShopBundle\Shop;

use ACA\ShopBundle\Shop\DBCommon;
use ACA\ShopBundle\Shop\OrderProduct;
use \Exception as Exception;

/**
 * Class OrderComplete represents all the operations needed to render a completed order
 *
 * @package ACA\ShopBundle\Shop
 */
class OrderComplete
{
    /**
     * Database handle
     *
     * @var DBCommon
     */
    protected $db;

    /**
     * Existing order_id
     *
     * @var int
     */
    protected $orderId;

    /**
     * Array of Product objects i.e. the products on this order
     *
     * @var OrderProduct[]
     */
    protected $OrderProducts = Array();

    /**
     * Total for this order
     *
     * @var float
     */
    protected $orderTotal = 0.00;

    /**
     * @param int $orderId Existing order_id
     */
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Load the existing order into properties on this object
     *
     * @throws Exception
     * @return bool
     */
    public function loadOrder()
    {
        if (!isset($this->db)) {
            throw new Exception('Please inject database handle prior to retrieving order');
        }

        $query = 'select * from aca_order_product where order_id = "' . $this->orderId . '"';
        $this->db->setQuery($query);
        $productsOL = $this->db->loadObjectList();
        if (empty($productsOL)) {
            throw new Exception('No products found on this order');
        }

        foreach ($productsOL as $productRow) {

            $OrderProduct = new OrderProduct($productRow->product_id);
            $OrderProduct->setDb($this->db);
            $OrderProduct->load();
            $OrderProduct->setQuantity($productRow->quantity);
            $OrderProduct->setPrice($productRow->price);

            $this->OrderProducts[] = $OrderProduct;
            $this->orderTotal += $productRow->price * $productRow->quantity;
        }
        return true;
    }

    /**
     * @return OrderProduct[]
     */
    public function getOrderProducts()
    {
        return $this->OrderProducts;
    }

    /**
     * @param DBCommon $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }
}