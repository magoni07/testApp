<?php

namespace Catalog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GoodsProp
 *
 * @ORM\Table(name="goods_prop", uniqueConstraints={@ORM\UniqueConstraint(name="index2", columns={"goods_id", "props_id"})}, indexes={@ORM\Index(name="fk_goods_prop_2_idx", columns={"props_id"}), @ORM\Index(name="IDX_9C86DE68B7683595", columns={"goods_id"})})
 * @ORM\Entity
 */
class GoodsProp
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
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=true)
     */
    private $value;

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
     * @var \Catalog\Entity\Props
     *
     * @ORM\ManyToOne(targetEntity="Catalog\Entity\Props")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="props_id", referencedColumnName="id")
     * })
     */
    private $props;



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
     * Set value
     *
     * @param string $value
     * @return GoodsProp
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set goods
     *
     * @param \Catalog\Entity\Goods $goods
     * @return GoodsProp
     */
    public function setGoods(\Catalog\Entity\Goods $goods = null)
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

    /**
     * Set props
     *
     * @param \Catalog\Entity\Props $props
     * @return GoodsProp
     */
    public function setProps(\Catalog\Entity\Props $props = null)
    {
        $this->props = $props;

        return $this;
    }

    /**
     * Get props
     *
     * @return \Catalog\Entity\Props 
     */
    public function getProps()
    {
        return $this->props;
    }
}
