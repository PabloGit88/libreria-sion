<?php

use Symfony\Component\Config\Loader\LoaderInterface;
use Odiseo\Bundle\ProjectBundle\Kernel\Kernel;

class AppKernel extends Kernel
{
    public function getPostBundles()
    {
        $bundles = array(
            new \FOS\UserBundle\FOSUserBundle(),
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            new JavierEguiluz\Bundle\EasyAdminBundle\EasyAdminBundle(),
            new Odiseo\Bundle\BackendBundle\OdiseoBackendBundle(),
            new Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle(),
            new Hype\MailchimpBundle\HypeMailchimpBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            new Beelab\TagBundle\BeelabTagBundle(),
            new Odiseo\Bundle\AppBundle\OdiseoAppBundle()
        );

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
