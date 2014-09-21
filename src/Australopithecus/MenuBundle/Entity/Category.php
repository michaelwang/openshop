<?php

namespace Australopithecus\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Australopithecus\MenuBundle\Entity\CategoryRepository")
 */
class Category
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="des", type="string", length=200)
     */
    private $des;

    /**
     *
     * @ORM\OneToMany(targetEntity="Product",mappedBy="category")
     */
    private $products;


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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set des
     *
     * @param string $des
     * @return Category
     */
    public function setDes($des)
    {
        $this->des = $des;

        return $this;
    }

    /**
     * Get des
     *
     * @return string 
     */
    public function getDes()
    {
        return $this->des;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add products
     *
     * @param \Australopithecus\MenuBundle\Entity\Product $products
     * @return Category
     */
    public function addProduct(\Australopithecus\MenuBundle\Entity\Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \Australopithecus\MenuBundle\Entity\Product $products
     */
    public function removeProduct(\Australopithecus\MenuBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    public function __toString()
    {
        return $this->name;
    }
}
