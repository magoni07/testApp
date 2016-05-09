<?php
namespace Catalog\Controller;

class CatalogControllerFactory
{
    public function __invoke($container)
    {
        return new CatalogController($this->get('Doctrine\ORM\EntityManager'));
    }
}