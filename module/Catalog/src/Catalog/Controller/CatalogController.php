<?php
namespace Catalog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
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

        //$products = $em->getRepository('\Catalog\Entity\Goods')->findAll();

        $view =  new ViewModel();

        $repository = $em->getRepository('\Catalog\Entity\Goods');
        $adapter = new DoctrineAdapter(new ORMPaginator($repository->createQueryBuilder('product')));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);

        $page = (int)$this->params()->fromQuery('page');
        if($page) $paginator->setCurrentPageNumber($page);

        $view->setVariable('paginator',$paginator);

        $products = $repository->findAll();

        $view->setVariable('products',$products);

        return new ViewModel(array(
            'products' => $products,
        ));
//        return $view;
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