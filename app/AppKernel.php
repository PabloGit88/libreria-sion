<?php

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class AppKernel extends BaseKernel
{
    public function getPreBundles()
    {
        return array();
    }

    public function getPostBundles()
    {
        $bundles = array(
            new \FOS\UserBundle\FOSUserBundle(),
            new \FOS\RestBundle\FOSRestBundle(),
            new \WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            new \JavierEguiluz\Bundle\EasyAdminBundle\EasyAdminBundle(),
            new \Odiseo\Bundle\BackendBundle\OdiseoBackendBundle(),
            new \Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle(), 
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new Beelab\TagBundle\BeelabTagBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new \Odiseo\Bundle\AppBundle\OdiseoAppBundle(),
        );

        return $bundles;
    }

    public function registerBundles()
    {
        $preBundles = $this->getPreBundles();

        $bundles = array(
            //Symfony base bundles
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),
            new \Symfony\Bundle\MonologBundle\MonologBundle(),
            new \Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new \Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new \Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),

            //Extra bundles
            new \Knp\Bundle\GaufretteBundle\KnpGaufretteBundle(),
            new \Vich\UploaderBundle\VichUploaderBundle(),
            new \Liip\ImagineBundle\LiipImagineBundle(),
            new \RaulFraile\Bundle\LadybugBundle\RaulFraileLadybugBundle(),
            new \JMS\SerializerBundle\JMSSerializerBundle($this),
            new \Knp\Bundle\MenuBundle\KnpMenuBundle(),

            new \Sylius\Bundle\ResourceBundle\SyliusResourceBundle(),

            //Odiseo Bundles
            new \Odiseo\Bundle\ProjectBundle\OdiseoProjectBundle(),
        );
        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new \Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new \Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new \Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new \Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        $postBundles = $this->getPostBundles();

        return array_merge($preBundles, array_merge($bundles, $postBundles));
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $rootDir = $this->getRootDir();

        $loader->load($rootDir.'/config/config_'.$this->environment.'.yml');
    }
}
