<?php
namespace Cart\Controller\Plugin;

use Cart\Entity\Cart;
use Doctrine\ORM\EntityManagerInterface;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class ShoppingCart extends AbstractPlugin
{
    private $session;
    private $identity;
    private $db;

    public function __construct(EntityManagerInterface $db, $session, $identity) {
        $this->db = $db;
        $this->session = $session;
        $this->identity = $identity;
    }
    
    /**
     * 
     * @return array
     */
    public function getCart(){
        $cart = [];
        if ($this->identity) {
            $userCart = $this->identity->getCart();

            foreach ($userCart as $product) {
                $goodsId = $product->getGoods()->getId();
                $pict = $product->getGoods()->getPictures()->first();
                $cart[$goodsId]['amount'] = $product->getAmount();
                $cart[$goodsId]['name'] = $product->getGoods()->getName();
                $cart[$goodsId]['price'] = $product->getGoods()->getPrice();
                $cart[$goodsId]['stock'] = $product->getGoods()->getAmount();
                $cart[$goodsId]['pict'] = $pict ? $pict->getPath() : 'nophoto.png';
            }
        } elseif ($this->session->offsetGet('cart')) {

            $cart = $this->session->offsetGet('cart');
        }
        return $cart;
    }

    public function insert($id, $qty){        
        $goods = $this->db->getRepository('\Catalog\Entity\Goods')->findOneBy(array('id' => $id));
        
        if ($this->identity) {
            $cart = new Cart();
            $cart->setUser($this->identity);
            $cart->setGoods($goods);
            $cart->setAmount($qty);
            $this->db->persist($cart);
            $this->db->flush();
        } else {
            if (! is_array($this->session['cart'])) {
                $this->session['cart'] = array();
            }
            $pict = $goods->getPictures()->first();
            $this->session['cart'][$id]['amount'] = $qty;
            $this->session['cart'][$id]['name'] = $goods->getName();
            $this->session['cart'][$id]['price'] = $goods->getPrice();
            $this->session['cart'][$id]['stock'] = $goods->getAmount();
            $this->session['cart'][$id]['pict'] = $pict ? $pict->getPath() : 'nophoto.png';
        }
    }

    public function delete($id){
        $cartElem = $this->getCartElem($id);

        if ($this->identity) {
            $this->db->remove($cartElem);
            $this->db->flush();
        } else {
            unset($this->session['cart'][$id]);
        }
    }

    public function update($id, $qty){       
        $cartElem = $this->getCartElem($id);
        if ($this->identity) {
            $cartElem->setAmount($qty);
            $this->db->flush();
        } else {
            $this->session['cart'][$id]['amount'] = $qty;
        }
    }
    
    public function merge(){
        if ($cartS = $this->session->offsetGet('cart')){ 
            foreach ($cartS as $key => $product){
                $amount = $product['amount'];
                $goods = $this->db->getRepository('\Catalog\Entity\Goods')->findOneBy(array('id' => $key));
                $cartElem = $this->db->getRepository('\Cart\Entity\Cart')
                    ->findOneBy(["goods" => $goods, "user" => $this->identity]);

                if (!$cartElem){
                    $cartElem = new Cart();
                    $cartElem->setUser($this->identity);
                    $cartElem->setGoods($goods);
                    $this->db->persist($cartElem);
                }

                $cartElem->setAmount($amount);
                $this->db->flush();
            }
            unset($this->session['cart']);
        }
    }

    /**
     * @return int
     */
    public function getCartTotalPrice(){
        $cart = $this->getCart();
        $totalPrice = 0;

        foreach ($cart as $product) {
            $price = $product['price'];
            $amount = $product['amount'];
            $totalPrice += $price * $amount;
        }

        return $totalPrice;
    }

    /**
     * @return int
     */
    public function getCartQty(){
        $cart = $this->getCart();
        $qty = 0;
        foreach ($cart as $product) {
            $amount = $product['amount'];
            $qty += $amount;
        }

        return $qty;
    }
    
    public function getCartElem($id){
        if ($this->identity) {
            $goods = $this->db->getRepository('\Catalog\Entity\Goods')->findOneBy(array('id' => $id));
            $cartElem = $this->db->getRepository('\Cart\Entity\Cart')
                ->findOneBy(["goods" => $goods, "user" => $this->identity]);
        } elseif (!empty($this->session['cart'][$id])) {
            $cartElem = $this->session['cart'][$id];
        } else {
            $cartElem = null;
        }
        return $cartElem;
    }
}