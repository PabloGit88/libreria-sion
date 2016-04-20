<?php

namespace Odiseo\Bundle\AppBundle\Entity;

use Beelab\TagBundle\Entity\AbstractTaggable;
use Doctrine\Common\Collections\ArrayCollection;

class Project extends AbstractTaggable
{
    protected $id;
    protected $name;
    protected $description;
    protected $images;
    protected $tags;
    protected $link;
    protected $position;
    protected $createdAt;
    protected $updatedAt;

    public function __construct()
    {
        parent::__construct();

        $this->images = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->position = 0;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setImages($images)
    {
        $this->images = $images;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function getMainImage()
    {
        $mainImage = null;

        foreach ($this->images as $image)
        {
            if($image->isMain())
            {
                $mainImage = $image;
            }
        }

        return $mainImage;
    }

    public function getNonMainImages()
    {
        $images = array();
        foreach ($this->images as $image)
        {
            if(!$image->isMain())
            {
                $images[] = $image;
            }
        }

        return $images;
    }

    public function setTagsText($tagsText)
    {
        $this->updatedAt = new \DateTime();

        return parent::setTagsText($tagsText);
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
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

    public function __toString()
    {
        return $this->name;
    }
}