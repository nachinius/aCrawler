<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * CachedContainerBuilder
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class CachedContainerBuilder extends Container
{
    private $parameters;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->parameters = $this->getDefaultParameters();

        $this->services =
        $this->scopedServices =
        $this->scopeStacks = array();

        $this->set('service_container', $this);

        $this->scopes = array();
        $this->scopeChildren = array();
        $this->methodMap = array(
            'app' => 'getAppService',
            'cache' => 'getCacheService',
            'fs' => 'getFsService',
            'locationcommand' => 'getLocationcommandService',
        );

        $this->aliases = array();
    }

    /**
     * Gets the 'app' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Console\Application A Symfony\Component\Console\Application instance.
     */
    protected function getAppService()
    {
        $this->services['app'] = $instance = new \Symfony\Component\Console\Application();

        $instance->add($this->get('locationcommand'));

        return $instance;
    }

    /**
     * Gets the 'cache' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Nachinius\Command\Components\Cache A Nachinius\Command\Components\Cache instance.
     */
    protected function getCacheService()
    {
        return $this->services['cache'] = new \Nachinius\Command\Components\Cache('/Users/ignacio/Sites/aCrawler/app/../data', $this->get('fs'));
    }

    /**
     * Gets the 'fs' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Filesystem\Filesystem A Symfony\Component\Filesystem\Filesystem instance.
     */
    protected function getFsService()
    {
        return $this->services['fs'] = new \Symfony\Component\Filesystem\Filesystem();
    }

    /**
     * Gets the 'locationcommand' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Nachinius\Command\LocationCommand A Nachinius\Command\LocationCommand instance.
     */
    protected function getLocationcommandService()
    {
        return $this->services['locationcommand'] = new \Nachinius\Command\LocationCommand($this->get('cache'));
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter($name)
    {
        $name = strtolower($name);

        if (!(isset($this->parameters[$name]) || array_key_exists($name, $this->parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }

        return $this->parameters[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameter($name)
    {
        $name = strtolower($name);

        return isset($this->parameters[$name]) || array_key_exists($name, $this->parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    /**
     * {@inheritdoc}
     */
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $this->parameterBag = new FrozenParameterBag($this->parameters);
        }

        return $this->parameterBag;
    }
    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'app.root_dir' => '/Users/ignacio/Sites/aCrawler/app',
        );
    }
}
