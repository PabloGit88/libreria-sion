<?php

namespace Odiseo\Bundle\AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;

class HomeImage
{
    protected $id;
    protected $homeConfiguration;
    protected $name;
    protected $imageName;
    protected $imageFile;
    protected $isMain;
    protected $createdAt;
    protected $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->isMain = false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setHomeConfiguration($homeConfiguration)
    {
        $this->homeConfiguration = $homeConfiguration;
    }

    public function getHomeConfiguration()
    {
        return $this->homeConfiguration;
    }
    /* vichuploader*/
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
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
        return (string)$this->getName();
    }
}