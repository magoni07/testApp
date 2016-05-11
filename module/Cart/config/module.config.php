<?php
namespace Cart;

use Cart\Factory\CartControllerFactory;
use Cart\Controller\CartController;

return array(
    'controllers' => array(
        'factories' => array(
            CartController::class => CartControllerFactory::class,
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'cart_entity' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(__DIR__ . '/../src/Cart/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Cart\Entity' => 'cart_entity',
                )
            )
        )
    ),
    'router' => array(
        'routes' => array(
            'cart' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/cart[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => CartController::class,
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'cart' => __DIR__ . '/../view',
        ),
    ),
);