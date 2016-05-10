<?php
namespace Catalog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use Zend\Json;
//use Doctrine\ORM\EntityManager;
//use Zend\Db\Adapter\AdapterInterface;

class CatalogController extends AbstractActionController
{
//    private $db;
//
//    public function __construct(AdapterInterface $db)
//    {
//        $this->db = $db;
//    }

    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repository = $em->getRepository('\Catalog\Entity\Goods');

        $adapter = new DoctrineAdapter(new ORMPaginator($repository->createQueryBuilder('product')));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(9);
        $paginator->setCurrentPageNumber((int)$this->params()->fromQuery('page', 1));

        $view =  new ViewModel();
        $view->setVariable('paginator',$paginator);

        return $view;
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