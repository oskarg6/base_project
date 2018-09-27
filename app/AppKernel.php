<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),

            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),

            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),

			new Knp\DoctrineBehaviors\Bundle\DoctrineBehaviorsBundle(),

            # traducciones
            new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(),

            # sonata admin
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\ClassificationBundle\SonataClassificationBundle(),
			new Application\Sonata\ClassificationBundle\ApplicationSonataClassificationBundle(),

			# sortable behavior Admin
			new Pix\SortableBehaviorBundle\PixSortableBehaviorBundle(),
			new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),

			# fos-ckeditor
			new FOS\CKEditorBundle\FOSCKEditorBundle(),
			new Sonata\FormatterBundle\SonataFormatterBundle(),
			new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),

			# media-bundle
			new Sonata\MediaBundle\SonataMediaBundle(),
			new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
			new JMS\SerializerBundle\JMSSerializerBundle(),
			new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),

			# user-bundle
			new FOS\UserBundle\FOSUserBundle(),
			new Sonata\UserBundle\SonataUserBundle(),
			new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),

        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();

            if ('dev' === $this->getEnvironment()) {
                $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
                $bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
            }
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) {
            $container->setParameter('container.autowiring.strict_mode', true);
            $container->setParameter('container.dumper.inline_class_loader', true);

            $container->addObjectResource($this);
        });
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
