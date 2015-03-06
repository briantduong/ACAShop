<?php

namespace ACA\ShopBundle\Shop;

use ACA\ShopBundle\Shop\DBCommon;
use ACA\ShopBundle\Shop\OrderProduct;
use ACA\ShopBundle\Shop\Product;
use \Exception as Exception;

class Order
{
    /**
     * Database handle
     *
     * @var DBCommon
     */
    protected $db;

    /**
     * OrderId
     * @var int
     */
    protected $orderId;

    /**
     * Array of Product objects on this order
     *
     * @var Product[]
     */
    protected $Products;

    /**
     * @param DBCommon $db Injected database dependency
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Place the order
     *
     * @throws Exception
     * @return bool
     */
    public function placeOrder()
    {
        if (empty($this->Products)) {
            throw new Exception('No products in your shopping cart!');
        }

        // Create an order record in the DB
        $query = 'insert into aca_order(user_id, order_date) values(123, NOW())';
        $this->db->setQuery($query);
        if (!$this->db->query()) {
            throw new Exception('Cannot create order record');
        }

        // Get the newly created order_id from MySQL
        $orderId = $this->db->getLastInsertId();
        if (empty($orderId)) {
            throw new Exception('Cannot get newly created order record from MySQL');
        }

        $this->orderId = $orderId;

        // Create order product records
        foreach ($this->Products as $Product) {

            $query = '
            insert into
                aca_order_product(order_id, product_id, quantity, price)
            values
                (' . $orderId . ', ' . $Product->getProductId() . ', 1, ' . $Product->getPrice() . ')';

            $this->db->setQuery($query);
            if (!$this->db->query()) {
                throw new Exception('Cannot insert order product record. '.$this->db->getQuery());
            }
        }
        return true;
    }

    /**
     * @param Product[] $Products
     */
    public function setProducts($Products)
    {
        $this->Products = $Products;
    }

    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->orderId;
    }
}