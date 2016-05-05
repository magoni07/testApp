<?php
namespace Catalog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CatalogController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $products = $em->getRepository('\Catalog\Entity\Goods')->findAll();
        return new ViewModel(array(
            'products' => $products,
        ));
    }

    public function viewAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->flashMessenger()->addErrorMessage('Product id doesn\'t set');
            return $this->redirect()->toRoute('catalog');
        }

        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $product = $objectManager
            ->getRepository('\Catalog\Entity\Goods')
            ->findOneBy(array('id' => $id));

        if (!$product) {
            $this->flashMessenger()->addErrorMessage(sprintf('Product with id %s doesn\'t exists', $id));
            return $this->redirect()->toRoute('catalog');
        }

        $view = new ViewModel(array(
            'product' => $product,
        ));

        return $view;
    }
}