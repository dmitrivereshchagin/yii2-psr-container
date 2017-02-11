<?php

namespace yii\psr\container;

use Psr\Container\ContainerInterface;
use yii\base\InvalidConfigException;
use yii\di\Container;

/**
 * PSR-11 container adapter for Yii 2.
 */
class ContainerAdapter implements ContainerInterface
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * Constructor.
     *
     * @param Container $container An instance of Container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Gets an entry from the container.
     *
     * @param string $id     The entry identifier
     * @param array  $params Constructor parameter values
     * @param array  $config Name-value pairs used to initialize object properties
     *
     * @throws ContainerException When an error occurred while retrieving an entry
     * @throws NotFoundException  When no entry was found
     *
     * @return mixed
     */
    public function get($id, array $params = [], array $config = [])
    {
        if (! $this->has($id)) {
            throw new NotFoundException(
                sprintf('Identifier "%s" is not known to the container.', $id)
            );
        }

        try {
            return $this->container->get($id, $params, $config);
        } catch (InvalidConfigException $e) {
            throw new ContainerException($e->getMessage());
        }
    }

    /**
     * Checks for whether an entry can be retrieved from the container.
     *
     * @param string $id The entry identifier
     *
     * @return bool
     */
    public function has($id)
    {
        return $this->container->has($id)
            || $this->container->hasSingleton($id)
            || class_exists($id);
    }
}
