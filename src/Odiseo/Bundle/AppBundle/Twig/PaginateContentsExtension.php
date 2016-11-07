<?php

namespace Odiseo\Bundle\AppBundle\Twig;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Adapter\DoctrineCollectionAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PaginateContentsExtension extends \Twig_Extension
{
    private $container;

    /**
     * Constructor.
     *
     * @param ContainerInterface $container A container.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('paginate', array($this, 'paginate'), array('is_safe' => array('html'))),
        );
    }

    public function paginate($contents, $viewName, $currentPage = 1, $maxPerPage = 1)
    {
        $adapter = new ArrayAdapter($contents);
        $pagerfanta = new Pagerfanta($adapter);

        $pagerfanta->setMaxPerPage($maxPerPage);
        $pagerfanta->setCurrentPage($currentPage);

        return $this->container->get('twig')->render($viewName, array(
            'pager' => $pagerfanta
        ));
    }

    public function getName()
    {
        return 'odiseo_paginate_contents_extension';
    }
}