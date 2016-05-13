<?php
namespace Cart\Controller;

use Cart\Entity\Cart;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManagerInterface;
use Zend\View\Model\JsonModel;

class CartController extends AbstractActionController
{
    /**
     * @var \Zend\Session\Container
     */
    private $session;
    
    private $db;

    public function __construct(EntityManagerInterface $db)
    {
        $this->db = $db;
    }

    /**
     *
     * @param \Zend\Session\Container $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $cart = $this->getCart();

        return new ViewModel([
            'cartGoods' => $cart
        ]);
    }

    /**
     * @return \Zend\Http\Response
     */
    public function addAction()
    {
        if ($identity = $this->getIdentity()) {

            $this->addToDB($identity);

        } else {
            $this->addToSession();
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

            if ($identity = $this->getIdentity()) {

                $goods = $this->db->getRepository('\Catalog\Entity\Goods')->findOneBy(array('id' => $goodsID));
                $cartElem = $this->db->getRepository('\Cart\Entity\Cart')->findOneBy(["goods" => $goods, "user" => $identity]);
                $this->db->remove($cartElem);
                $this->db->flush();

            } else {
                unset($this->session['cart'][$goodsID]);
            }
        }

        return new JsonModel(['total' => $this->getCartTotalPrice()]);
    }

    /**
     * @return JsonModel
     */
    public function updateAction(){
        $request = $this->getRequest();

        if ($request->isXmlHttpRequest()) {

            $goodsID = $request->getPost()->get('id');
            $amount = $request->getPost()->get('qty');

            if ($identity = $this->getIdentity()) {

                $goods = $this->db->getRepository('\Catalog\Entity\Goods')->findOneBy(array('id' => $goodsID));
                $cartElem = $this->db->getRepository('\Cart\Entity\Cart')->findOneBy(["goods" => $goods, "user" => $identity]);
                $cartElem->setAmount($amount);
                $this->db->flush();

            } else {
                $this->session['cart'][$goodsID]['amount'] = $amount;
            }
        }

        return new JsonModel(['total' => $this->getCartTotalPrice()]);
    }

    /**
     * @return \Zend\Http\Response
     */
    public function updateloginAction()
    {
        if ($cartS = $this->session->offsetGet('cart')){

            $identity = $this->getIdentity();

            foreach ($cartS as $key => $product){

                $amount = $product['amount'];
                $goods = $this->db->getRepository('\Catalog\Entity\Goods')->findOneBy(array('id' => $key));
                $cartElem = $this->db->getRepository('\Cart\Entity\Cart')->findOneBy(["goods" => $goods, "user" => $identity]);

                if (!$cartElem){
                    $cartElem = new Cart();
                    $cartElem->setUser($identity);
                    $cartElem->setGoods($goods);
                    $this->db->persist($cartElem);
                }

                $cartElem->setAmount($amount);                
                $this->db->flush();
            }
            unset($this->session['cart']);
        }

        return $this->redirect()->toRoute('cart');
    }

    /**
     * @param $user
     */
    protected function addToDB($user)
    {
        $request = $this->getRequest();

        if ($request->isPost()) {

            $goodsID = $request->getPost()->get('goods');
            $amount = $request->getPost()->get('amount');

            $goods = $this->db->getRepository('\Catalog\Entity\Goods')->findOneBy(array('id' => $goodsID));

            $cart = new Cart();
            $cart->setUser($user);
            $cart->setGoods($goods);
            $cart->setAmount($amount);

            $this->db->persist($cart);
            $this->db->flush();
        }
    }

    /**
     *
     */
    protected function addToSession(){
        $request = $this->getRequest();

        if ($request->isPost()) {

            $goodsID = $request->getPost()->get('goods');
            $goods = $this->db->getRepository('\Catalog\Entity\Goods')->findOneBy(array('id' => $goodsID));

            if (! is_array($this->session['cart'])) {
                $this->session['cart'] = array();
            }

            $this->session['cart'][$goodsID]['amount'] = $request->getPost()->get('amount');
            $this->session['cart'][$goodsID]['name'] = $goods->getName();
            $this->session['cart'][$goodsID]['price'] = $goods->getPrice();
            $this->session['cart'][$goodsID]['stock'] = $goods->getAmount();
            $this->session['cart'][$goodsID]['pict'] = $goods->getPictures()->first() ? $goods->getPictures()->first()->getPath() : 'nophoto.png';
        }
    }

    /**
     * @return bool
     */
    protected function getIdentity()
    {
        if ($this->zfcUserAuthentication()->hasIdentity()) {

            $res = $this->zfcUserAuthentication()->getIdentity();
        } else {
            $res = false;
        }
        return $res;
    }

    /**
     * @return array|mixed
     */
    protected function getCart(){
        $cart = [];
        if ($identity = $this->getIdentity()) {

            $userCart = $identity->getCart();

            foreach ($userCart as $product) {
                $goodsId = $product->getGoods()->getId();
                $cart[$goodsId]['amount'] = $product->getAmount();
                $cart[$goodsId]['name'] = $product->getGoods()->getName();
                $cart[$goodsId]['price'] = $product->getGoods()->getPrice();
                $cart[$goodsId]['stock'] = $product->getGoods()->getAmount();
                $cart[$goodsId]['pict'] = $product->getGoods()->getPictures()->first() ? $product->getGoods()->getPictures()->first()->getPath() : 'nophoto.png';

            }
        } elseif ($this->session->offsetGet('cart')) {

            $cart = $this->session->offsetGet('cart');
        }
        return $cart;
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
        $qty = count($cart);

        return $qty;
    }
}