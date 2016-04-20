<?php

namespace Odiseo\Bundle\AppBundle\Entity;

use Beelab\TagBundle\Tag\TagInterface;

/**
 * Tag
 */
class Tag implements TagInterface
{
    protected $id;
    protected $name;
    protected $isFilter;
    protected $projects;

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setProjects($projects)
    {
        $this->projects = $projects;

        return $this;
    }

    public function getProjects()
    {
        return $this->projects;
    }

    public function addProject($project)
    {
        $this->projects[] = $project;

        return $this;
    }

    public function removeProject($project)
    {
        $this->projects->removeElement($project);
    }

    public function hasProject($project)
    {
        return $this->projects->contains($project);
    }

    public function setIsFilter($isFilter)
    {
        $this->isFilter = $isFilter;
    }

    public function getIsFilter()
    {
        return $this->isFilter;
    }

    public function __toString()
    {
        return (string) $this->name;
    }
}