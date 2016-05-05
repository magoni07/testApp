<?php
namespace Catalog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

class CatalogController extends AbstractActionController
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'products' => $this->getEntityManager()->getRepository('Catalog\Entity\Goods')->findAll(),
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
            'product' => $product->getArrayCopy(),
        ));

        return $view;
    }
}