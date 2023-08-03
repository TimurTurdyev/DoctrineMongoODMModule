<?php

declare(strict_types=1);

namespace DoctrineMongoODMModule\Service;

use DoctrineMongoODMModule\Collector\MongoLoggerCollector;
use DoctrineMongoODMModule\Logging\DebugStack;
use DoctrineMongoODMModule\Options;
use Interop\Container\ContainerInterface;

use function assert;

/**
 * Mongo Logger Configuration ServiceManager factory
 */
final class MongoLoggerCollectorFactory extends AbstractFactory
{
    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->name = $name;
    }

    /**
     * {@inheritDoc}
     *
     * @return MongoLoggerCollector
     */
    public function __invoke(ContainerInterface $container, $requestedName, array|null $options = null)
    {
        $settings = $this->getOptions($container, 'mongo_logger_collector');
        assert($settings instanceof Options\MongoLoggerCollector);

        if ($settings->getMongoLogger()) {
            $debugStackLogger = $container->get($settings->getMongoLogger());
        } else {
            $debugStackLogger = new DebugStack();
        }

        return new MongoLoggerCollector($debugStackLogger, $settings->getName());
    }

    public function getOptionsClass(): string
    {
        return Options\MongoLoggerCollector::class;
    }
}
