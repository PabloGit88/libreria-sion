<?php

namespace Odiseo\Bundle\AppBundle\Entity;

use Beelab\TagBundle\Entity\AbstractTaggable;
use Beelab\TagBundle\Tag\TagInterface;
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
    protected $files;

    public function __construct()
    {
        parent::__construct();

        $this->images = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->files = new ArrayCollection();
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
        foreach($images as $image)
        {
            $this->addImage($image);
        }
    }

    public function getImages()
    {
        return $this->images;
    }

    public function addImage(ProjectImage $image)
    {
        $this->images->add($image);
        $image->setProject($this);
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

    /**
     * {@inheritdoc}
     */
    public function addTag(TagInterface $tag)
    {
        if (!$this->hasTag($tag)) {
            $this->tags[] = $tag;
            $tag->addProject($this);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeTag(TagInterface $tag)
    {
        if ($this->hasTag($tag)) {
            parent::removeTag($tag);
            $tag->removeProject($this);
        }

        return $this;
    }

    public function setTagsText($tagsText)
    {
        $this->updatedAt = new \DateTime();

        return parent::setTagsText($tagsText);
    }

    public function getTagsTextWhitespace()
    {
        $this->tagsText = implode(' ', $this->tags->toArray());

        return $this->tagsText;
    }

    /**
     * {@inheritdoc}
     */
    public function getTagNames()
    {
        return empty($this->getTagsText()) ? array() : array_map('trim', explode(',', $this->getTagsText()));
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return mixed
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param mixed $files
     */
    public function setFiles($files)
    {
        foreach($files as $file)
        {
            $this->addFile($file);
        }
    }

    public function addFile(ProjectFile $file)
    {
        $this->files->add($file);
        $file->setProject($this);
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
        return (string) $this->name;
    }
}