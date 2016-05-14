<?php
namespace Cart\Factory;

use Zend\Session\Container;
use Cart\Controller\Plugin\ShoppingCart;

class ShoppingCartFactory 
{    
    public function __invoke($container)
    {
        $parentLocator = $container->getServiceLocator();
        $db = $parentLocator->get('Doctrine\ORM\EntityManager');
        $sm = $parentLocator->get('ServiceManager');
        $auth = $sm->get('zfcuser_auth_service');
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
        } else {
            $identity = null;
        }

        $cart = new ShoppingCart($db, new Container('cart'), $identity); 
        return $cart;
    }
}