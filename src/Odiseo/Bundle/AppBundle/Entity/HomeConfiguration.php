<?php

namespace Odiseo\Bundle\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\DateTime;

class HomeConfiguration
{
    protected $id;
    protected $images;
    protected $createdAt;
    protected $updatedAt;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setImages($images)
    {
        foreach($images as $image)
        {
            $this->addImage($image);
        }
    }

    public function getImages()
    {
        return $this->images;
    }

    public function addImage(HomeImage $image)
    {
        $this->images->add($image);
        $image->setHomeConfiguration($this);
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}