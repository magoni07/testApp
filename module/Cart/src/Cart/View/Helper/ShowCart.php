<?php
namespace Cart\View\Helper;

use Zend\Session\Container;
use Zend\View\Helper\AbstractHelper;


class ShowCart extends AbstractHelper
{
    public function __invoke()
    {
        $cost = 0;
        $qty = 0;

        $sm = $this->getView()->getHelperPluginManager()->getServiceLocator()->get('ServiceManager');
        $auth = $sm->get('zfcuser_auth_service');

        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
            $cart = $identity->getCart();
            foreach ($cart as $product) {
                $price = $product->getGoods()->getPrice();
                $amount = $product->getAmount();;
                $cost += $price * $amount;
                $qty += $amount;
            }
        } else {
            $cart = new Container('cart');
            if (!empty($cart['cart'])){
                foreach ($cart['cart'] as $product) {
                    $price = $product['price'];
                    $amount = $product['amount'];
                    $cost += $price * $amount;
                    $qty += $amount;
                }
            }
        }

        switch ($qty) {
            case 0: $text = "В корзине<br>товаров нет";
                break;
            case 1: $text = "В корзине 1 товар <br> на сумму $cost грн.";
                break;
            case 2:
            case 3:
            case 4: $text = "В корзине $qty товара <br> на сумму $cost грн.";
                break;
            default: $text = "В корзине $qty товаров <br> на сумму $cost грн.";
        }
        $result = ' <a href="/cart">
                        <div class="media">
                          <div class="media-left media-middle">
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                          </div>
                          <div class="media-body cart">'.$text.'</div>
                        </div>
                    </a>';
        return $result;
    }
}