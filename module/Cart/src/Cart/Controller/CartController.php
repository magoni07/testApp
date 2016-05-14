<?php
namespace Cart\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class CartController extends AbstractActionController
{
    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $cart = $this->ShoppingCart()->getCart();

        return new ViewModel([
            'cartGoods' => $cart
        ]);
    }

    /**
     * @return \Zend\Http\Response
     */
    public function addAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->ShoppingCart()->insert($request);
        }
        return $this->redirect()->toRoute('cart');
    }

    /**
     * @return JsonModel
     */
    public function deleteAction()
    {
        $request = $this->getRequest();

        if ($request->isXmlHttpRequest()) {
            $this->ShoppingCart()->delete($request);            
        }

        return new JsonModel(['total' => $this->ShoppingCart()->getCartTotalPrice()]);
    }

    /**
     * @return JsonModel
     */
    public function updateAction(){
        $request = $this->getRequest();

        if ($request->isXmlHttpRequest()) {
            $this->ShoppingCart()->update($request);
        }

        return new JsonModel(['total' => $this->ShoppingCart()->getCartTotalPrice()]);
    }

    /**
     * @return \Zend\Http\Response
     */
    public function mergeAction()
    {
        $this->ShoppingCart()->merge();

        return $this->redirect()->toRoute('cart');
    }
}