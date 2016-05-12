<?php
namespace Cart\Controller;

use Cart\Entity\Cart;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManagerInterface;

class CartController extends AbstractActionController
{
    /**
     * @var \Zend\Session\Container
     */
    private $session;
    
    private $db;

    /**
     *
     * @param \Zend\Session\Container $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }
    
    public function __construct(EntityManagerInterface $db)
    {
        $this->db = $db;
    }
    
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

            }
        } else {
            $cart = $this->session->offsetGet('cart');
        }

        $view = new ViewModel();
        $view->setVariable('cartGoods', $cart);
        return $view;
    }

    public function addAction()
    {
        if ($identity = $this->getIdentity()) {
            $this->addToDB($identity);
        } else {
            $this->addToSession();
        }
        return $this->redirect()->toRoute('cart');
    }

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
            $this->session['cart'][$goodsID]['pict'] = $goods->getPictures()->first() ? $goods->getPictures()->first()->getPath() : 'nophoto.png';
        }
    }

    protected function getIdentity()
    {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            return $this->zfcUserAuthentication()->getIdentity();
        } else {
            return false;
        }
    }
}