<?php
namespace Cart\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Cart\Factory\CartControllerFactory;
use Zend\ServiceManager\ServiceManager;

class ShowCart extends AbstractHelper
{
    public function __invoke()
    {
        $sm = new ServiceManager();

        $cart = $sm->get(CartControllerFactory::class);
        $cost = $cart->getCartTotalPrice();
        $qty = $cart->getCartQty();
        switch ($qty) {
            case 0: $text = "В корзине ничего нет";
                break;
            case 1: $text = "В корзине 1 товар <br> на сумму $cost грн.";
                break;
            case 2:
            case 3:
            case 4: $text = "В корзине $qty товара <br> на сумму $cost грн.";
                break;
            default: $text = "В корзине $qty товаров <br> на сумму $cost грн.";
        }
        $result = '<div id="cart">
                        <a href="/cart">
                            <div id="cart-img">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                            </div>
                            <div>'.$text.'</div>
                        </a>
                    </div>';
        return $result;
    }
}