<?php

namespace Australopithecus\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Australopithecus\MenuBundle\Entity\ProductRepository")
 */
class Product
{

    /**
     *
     * @ORM\OneToMany(targetEntity="ProductPictures",mappedBy="product")
     */
    private $pictures;

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
     * @ORM\Column(name="name", type="string", length=200)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="des", type="text")
     */
    private $des;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;


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
     * @return Product
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
     * @return Product
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
        $this->pictures = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add pictures
     *
     * @param \Australopithecus\MenuBundle\Entity\ProductPictures $pictures
     * @return Product
     */
    public function addPicture(\Australopithecus\MenuBundle\Entity\ProductPictures $pictures)
    {
        $this->pictures[] = $pictures;

        return $this;
    }

    /**
     * Remove pictures
     *
     * @param \Australopithecus\MenuBundle\Entity\ProductPictures $pictures
     */
    public function removePicture(\Australopithecus\MenuBundle\Entity\ProductPictures $pictures)
    {
        $this->pictures->removeElement($pictures);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Set category
     *
     * @param \Australopithecus\MenuBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\Australopithecus\MenuBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Australopithecus\MenuBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
