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
            $goodsID = $request->getPost()->get('goods');
            $amount = $request->getPost()->get('amount');
            $this->ShoppingCart()->insert($goodsID, $amount);
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
            $goodsID = $request->getPost()->get('id');
            $this->ShoppingCart()->delete($goodsID);            
        }

        return new JsonModel(['total' => $this->ShoppingCart()->getCartTotalPrice(),
                                'qty' => $this->ShoppingCart()->getCartQty()]);
    }

    /**
     * @return JsonModel
     */
    public function updateAction(){
        $request = $this->getRequest();

        if ($request->isXmlHttpRequest()) {
            $goodsID = $request->getPost()->get('id');
            $amount = $request->getPost()->get('qty');
            $this->ShoppingCart()->update($goodsID, $amount);
        }

        return new JsonModel(['total' => $this->ShoppingCart()->getCartTotalPrice(),
                                'qty' => $this->ShoppingCart()->getCartQty()]);
    }

    /**
     * @return \Zend\Http\Response
     */
    public function mergeAction()
    {
        $this->ShoppingCart()->merge();

        return $this->redirect()->toRoute('zfcuser');
    }
}