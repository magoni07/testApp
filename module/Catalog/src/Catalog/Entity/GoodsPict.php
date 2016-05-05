<?php

namespace Catalog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GoodsPict
 *
 * @ORM\Table(name="goods_pict", indexes={@ORM\Index(name="fk_goods_pict_1_idx", columns={"goods_id"})})
 * @ORM\Entity
 */
class GoodsPict
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
     * @ORM\Column(name="path", type="string", length=45, nullable=false)
     */
    private $path;

    /**
     * @var \Catalog\Entity\Goods
     *
     * @ORM\ManyToOne(targetEntity="Catalog\Entity\Goods", inversedBy="pictures")
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
     * Set path
     *
     * @param string $path
     * @return GoodsPict
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set goods
     *
     * @param \Catalog\Entity\Goods $goods
     * @return GoodsPict
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
}
