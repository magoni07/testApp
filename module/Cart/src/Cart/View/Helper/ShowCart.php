<?php
namespace Cart\View\Helper;

use Cart\Factory\ShoppingCartFactory;
use Zend\View\Helper\AbstractHelper;


class ShowCart extends AbstractHelper
{
    public function __invoke()
    {
        //$sl = $this->getServiceLocator();
        $cost = 90;
        $qty=1;
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
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>                      
                            <span>'.$text.'</span>
                        </a>
                    </div>';
        return $result;
    }
}