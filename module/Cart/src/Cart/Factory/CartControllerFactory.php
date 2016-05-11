<?php
namespace Cart\Factory;

use Cart\Controller\CartController;

class CartControllerFactory
{
    public function __invoke($container)
    {
        $parentLocator = $container->getServiceLocator();
        return new CartController($parentLocator->get('Doctrine\ORM\EntityManager'));
    }
}