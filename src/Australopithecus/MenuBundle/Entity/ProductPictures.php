<?php

namespace Australopithecus\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * ProductPictures
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Australopithecus\MenuBundle\Entity\ProductPicturesRepository")
 * @ORM\HasLifecycleCallbacks
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

    private $temp;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        if (isset($this->path))
        {
            $this->temp = $this->path;
            $this->path = null;
        }else{
            $this->path = "initial";
        }        
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if(null !== $this->getFile())
        {
            $filename = sha1(uniqid(mt_rand(),true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    public function getFile(UploadedFile $file = null)
    {
        return $this->file;
    }

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

    public function getAbsolutePath()
    {
        return null == $this->path
            ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/documents';
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null == $this->getFile())
        {
            return;
        }
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->path
        );
        if(isset($this->temp))
        {
            unlink($this->getUploadRootDir().'/'.$this->temp);
            $this->temp = null;
        }        
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if($file = $this->getAbsolutePath())
        {
            unlink($file);
        }
    }
}
