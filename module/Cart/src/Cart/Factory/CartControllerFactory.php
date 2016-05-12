<?php
namespace Cart\Factory;

use Cart\Controller\CartController;
use Zend\Session\Container;

class CartControllerFactory
{
    public function __invoke($container)
    {
        $parentLocator = $container->getServiceLocator();
        $cart = new CartController($parentLocator->get('Doctrine\ORM\EntityManager'));
        $cart->setSession(new Container('cart'));
        return $cart;
    }
}