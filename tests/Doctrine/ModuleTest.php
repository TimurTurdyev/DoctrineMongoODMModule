<?php

declare(strict_types=1);

namespace DoctrineMongoODMModuleTest\Doctrine;

use DoctrineMongoODMModule\Module;
use Laminas\EventManager\Event;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;

class ModuleTest extends TestCase
{
    public function testOdmDefaultIsUsedAsTheDocumentManagerIfNoneIsProvided(): void
    {
        $documentManager = $this->getMockbuilder('Doctrine\ODM\MongoDB\DocumentManager')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceManager = $this->createMock('Laminas\ServiceManager\ServiceManager');
        $serviceManager->expects(self::once())
            ->method('get')
            ->with('doctrine.documentmanager.odm_default')
            ->will(self::returnValue($documentManager));

        $application = new Application();
        $event       = new Event('loadCli.post', $application, ['ServiceManager' => $serviceManager]);

        $module = new Module();
        $module->loadCli($event);

        self::assertSame($documentManager, $application->getHelperSet()->get('documentManager')->getDocumentManager());
    }

    public function testDocumentManagerUsedCanBeSpecifiedInCommandLineArgument(): void
    {
        $argvBackup = $_SERVER['argv'];

        $documentManager = $this->getMockbuilder('Doctrine\ODM\MongoDB\DocumentManager')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceManager = $this->createMock('Laminas\ServiceManager\ServiceManager');
        $serviceManager->expects(self::once())
            ->method('get')
            ->with('doctrine.documentmanager.some_other_name')
            ->will(self::returnValue($documentManager));

        $application = new Application();
        $event       = new Event('loadCli.post', $application, ['ServiceManager' => $serviceManager]);

        $_SERVER['argv'][] = '--documentmanager=some_other_name';

        $module = new Module();
        $module->loadCli($event);

        $_SERVER['argv'] = $argvBackup;

        self::assertSame($documentManager, $application->getHelperSet()->get('documentManager')->getDocumentManager());
    }
}
