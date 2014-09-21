<?php

namespace Australopithecus\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductPictures
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Australopithecus\MenuBundle\Entity\ProductPicturesRepository")
 */
class ProductPictures
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productpictures")
     * @ORM\JoinColumn(name="productId", referencedColumnName="id")
     */
    private $product;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=200)
     */
    private $path;


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
     * Set productId
     *
     * @param integer $productId
     * @return ProductPictures
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return ProductPictures
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
     * Set product
     *
     * @param \Australopithecus\MenuBundle\Entity\Product $product
     * @return ProductPictures
     */
    public function setProduct(\Australopithecus\MenuBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Australopithecus\MenuBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
