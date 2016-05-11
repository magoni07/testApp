<?php
namespace Catalog\Factory;

use Catalog\Controller\CatalogController;

class CatalogControllerFactory
{
    public function __invoke($container)
    {
        $parentLocator = $container->getServiceLocator();
        return new CatalogController($parentLocator->get('Doctrine\ORM\EntityManager'));
    }
}