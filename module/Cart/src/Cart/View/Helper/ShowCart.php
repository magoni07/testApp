<?php
namespace Cart\View\Helper;

use Zend\View\Helper\AbstractHelper;


class ShowCart extends AbstractHelper
{
    public function __invoke()
    {
        //$cart = $this->ShoppingCart();
        
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