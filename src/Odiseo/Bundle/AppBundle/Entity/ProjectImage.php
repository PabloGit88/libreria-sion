<?php

namespace Odiseo\Bundle\AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;

class ProjectImage
{
    protected $id;
    protected $project;
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

    public function setProject($project)
    {
        $this->project = $project;
    }

    public function getProject()
    {
        return $this->project;
    }

    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    public function getImageName()
    {
        return $this->imageName;
    }

    public function setImageFile(File $imageFile)
    {
        $this->imageFile = $imageFile;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setIsMain($isMain)
    {
        $this->isMain = $isMain;
    }

    public function getIsMain()
    {
        return $this->isMain;
    }

    public function isMain()
    {
        return $this->getIsMain();
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
        return (string)$this->getId();
    }
}