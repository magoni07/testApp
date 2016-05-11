<?php
namespace Cart\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CartController extends AbstractActionController
{
    public function indexAction()
    {
        $cart = [];
        if ($identity = $this->getIdentity()) {

            $userCart = $identity->getCart();

            foreach ($userCart as $product) {
                $goodsId = $product->getId();
                $cart[$goodsId]['amount'] = $product->getAmount();
                $cart[$goodsId]['name'] = $product->getGoods()->getName();
                $cart[$goodsId]['price'] = $product->getGoods()->getPrice();
                $cart[$goodsId]['pict'] = $product->getGoods()->getPictures()->first() ? $product->getGoods()->getPictures()->first()->getPath() : 'nophoto.png';
                $cart[$goodsId]['cost'] = $product->getAmount()*$product->getGoods()->getPrice();
            }
        }
        $view = new ViewModel();
        $view->setVariable('cartGoods', $cart);
        return $view;
    }

    protected function getIdentity()
    {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            return $this->zfcUserAuthentication()->getIdentity();;
        } else {
            return false;
        }
    }
}