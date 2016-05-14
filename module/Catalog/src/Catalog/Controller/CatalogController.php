<?php
namespace Catalog\Controller;

use Catalog\Form\ItemForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use Doctrine\ORM\EntityManagerInterface;

class CatalogController extends AbstractActionController
{
    private $db;

    public function __construct(EntityManagerInterface $db)
    {
        $this->db = $db;
    }

    public function indexAction()
    {        
        $repository = $this->db->getRepository('\Catalog\Entity\Goods');

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
        $id = (int) $this->params()->fromRoute('id');
        if (!$id) {
            $this->flashMessenger()->addErrorMessage('Не указан id товара');
            return $this->redirect()->toRoute('catalog');
        }

        $goods = $this->db->getRepository('\Catalog\Entity\Goods')->findOneBy(array('id' => $id));
        
        if (!$goods) {
            $this->flashMessenger()->addErrorMessage(sprintf('Такого товара не существует', $id));
            return $this->redirect()->toRoute('catalog');
        }

        $product['id'] = $goods->getId();
        $product['name'] = $goods->getName();
        $product['price'] = $goods->getPrice();
        $product['descr'] = $goods->getDescr();
        
        $pictures = $goods->getPictures()->toArray();
        foreach($pictures as $pict) {
            $product['pictures'][] = $pict->getPath();
        }
        
        $properties = $goods->getProperties()->toArray();
        foreach($properties as $property) {
            $name = $property->getProps()->getName();
            $value = $property->getValue();
            $product['properties']["$name"] = $value;
        }

        $product['inCart'] = !empty($this->ShoppingCart()->getCartElem("$id"));

        $form = new ItemForm();
        $view = new ViewModel(array(
            'product' => $product,
            'form' => $form,
        ));

        return $view;
    }
}