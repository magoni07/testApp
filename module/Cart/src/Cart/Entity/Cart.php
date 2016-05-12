<?php

namespace Cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cart
 *
 * @ORM\Table(name="cart", uniqueConstraints={@ORM\UniqueConstraint(name="index2", columns={"user_id", "goods_id"})}, indexes={@ORM\Index(name="fk_user_goods_2_idx", columns={"goods_id"}), @ORM\Index(name="IDX_BA388B7A76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class Cart
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=true)
     */
    private $amount;

    /**
     * @var \MyUser\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="MyUser\Entity\User", inversedBy="cart")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Catalog\Entity\Goods
     *
     * @ORM\ManyToOne(targetEntity="Catalog\Entity\Goods")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="goods_id", referencedColumnName="id")
     * })
     */
    private $goods;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return Cart
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set user
     *
     * @param \MyUser\Entity\User $user
     * @return Cart
     */
    public function setUser($user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MyUser\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set goods
     *
     * @param \Catalog\Entity\Goods $goods
     * @return Cart
     */
    public function setGoods($goods = null)
    {
        $this->goods = $goods;

        return $this;
    }

    /**
     * Get goods
     *
     * @return \Catalog\Entity\Goods 
     */
    public function getGoods()
    {
        return $this->goods;
    }
}
