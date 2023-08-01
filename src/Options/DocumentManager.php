<?php

declare(strict_types=1);

namespace DoctrineMongoODMModule\Options;

use Laminas\Stdlib\AbstractOptions;

/**
 * Document manager options for doctrine mongo
 */
final class DocumentManager extends AbstractOptions
{
    /**
     * Set the configuration key for the Configuration. Configuration key
     * is assembled as "doctrine.configuration.{key}" and pulled from
     * service locator.
     */
    protected string $configuration = 'odm_default';

    /**
     * Set the connection key for the Connection. Connection key
     * is assembled as "doctrine.connection.{key}" and pulled from
     * service locator.
     */
    protected string $connection = 'odm_default';

    /**
     * Set the event manager key for the event manager. Key
     * is assembled as "doctrine.eventManager.{key} and pulled from
     * service locator.
     */
    protected string $eventManager = 'odm_default';

    public function setConfiguration(mixed $configuration): self
    {
        $this->configuration = (string) $configuration;

        return $this;
    }

    public function getConfiguration(): string
    {
        return 'doctrine.configuration.' . $this->configuration;
    }

    public function setConnection(mixed $connection): self
    {
        $this->connection = (string) $connection;

        return $this;
    }

    public function getConnection(): string
    {
        return 'doctrine.connection.' . $this->connection;
    }

    public function getEventManager(): string
    {
        return 'doctrine.eventmanager.' . $this->eventManager;
    }

    public function setEventManager(mixed $eventManager): self
    {
        $this->eventManager = (string) $eventManager;

        return $this;
    }
}
