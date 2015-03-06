<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new ACA\ShopBundle\ACAShopBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
    }

    /**
     * @see http://www.whitewashing.de/2013/08/19/speedup_symfony2_on_vagrant_boxes.html
     * @return string
     */
    public function getCacheDir()
    {
        if(php_sapi_name() == 'cli'){
            return '/tmp/cache';
        }

        if (in_array($this->environment, array('dev', 'test'))) {
            return '/dev/shm/cache/' .  $this->environment;
        }

        return parent::getCacheDir();
    }

    /**
     * @see http://www.whitewashing.de/2013/08/19/speedup_symfony2_on_vagrant_boxes.html
     * @return string
     */
    public function getLogDir()
    {
        if(php_sapi_name() == 'cli'){
            return '/tmp/logs';
        }

        if (in_array($this->environment, array('dev', 'test'))) {
            return '/dev/shm/logs';
        }

        return parent::getLogDir();
    }
}
