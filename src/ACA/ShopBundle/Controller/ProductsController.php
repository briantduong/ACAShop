<?php

namespace ACA\ShopBundle\Controller;

use ACA\ShopBundle\Shop\Factory;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ProductsController is responsible for product related functionality
 *
 * @package ACA\ShopBundle\Controller
 */
class ProductsController extends Controller
{
    /**
     * Product listing, display all products we have for sale
     *
     * @return Response
     */
    public function listingAction()
    {
        /** @var Factory $Factory */
        $Factory = $this->get('factory');

        /** @var Product[] $Products */
        $Products = $Factory->getAllProducts();

        return $this->render(
            'ACAShopBundle:Products:list.html.twig',
            array(
                'Products' => $Products
            )
        );
    }

    /**
     * Show the add product form that allows us to add a product to the aca_product table
     *
     * @return Response
     */
    public function addAction()
    {
        return $this->render('ACAShopBundle:Products:add.html.twig');
    }
}
