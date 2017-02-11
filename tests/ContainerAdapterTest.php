<?php

namespace yii\psr\container\tests;

use yii\di\Container;
use yii\psr\container\ContainerAdapter;

class ContainerAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testCanBeConstructedFromContainer()
    {
        $definition = function () {
            return new \stdClass();
        };

        $container = new Container();
        $container->set('factory', $definition);
        $container->setSingleton('singleton', $definition);

        $adapter = new ContainerAdapter($container);
        $this->assertInstanceOf('yii\psr\container\ContainerAdapter', $adapter);

        return $adapter;
    }

    /**
     * @depends testCanBeConstructedFromContainer
     */
    public function testFactoryEntryCanBeRetrieved(ContainerAdapter $adapter)
    {
        $entry1 = $adapter->get('factory');
        $this->assertInstanceOf('stdClass', $entry1);

        $entry2 = $adapter->get('factory');
        $this->assertNotSame($entry1, $entry2);
    }

    /**
     * @depends testCanBeConstructedFromContainer
     */
    public function testSingletonEntryCanBeRetrieved(ContainerAdapter $adapter)
    {
        $entry1 = $adapter->get('singleton');
        $this->assertInstanceOf('stdClass', $entry1);

        $entry2 = $adapter->get('singleton');
        $this->assertSame($entry1, $entry2);
    }

    /**
     * @depends testCanBeConstructedFromContainer
     */
    public function testEntryForExistingClassCanBeRetrieved(ContainerAdapter $adapter)
    {
        $entry1 = $adapter->get('stdClass');
        $this->assertInstanceOf('stdClass', $entry1);

        $entry2 = $adapter->get('stdClass');
        $this->assertNotSame($entry1, $entry2);
    }

    /**
     * @depends testCanBeConstructedFromContainer
     * @expectedException \yii\psr\container\ContainerException
     */
    public function testExceptionIsRaisedOnContainerFailure(ContainerAdapter $adapter)
    {
        $adapter->get('yii\psr\container\tests\stubs\AbstractClass');
    }

    /**
     * @depends testCanBeConstructedFromContainer
     * @expectedException \yii\psr\container\NotFoundException
     */
    public function testExceptionIsRaisedOnMissingEntry(ContainerAdapter $adapter)
    {
        $adapter->get('missing');
    }

    /**
     * @depends testCanBeConstructedFromContainer
     */
    public function testFactoryEntryCanBeFound(ContainerAdapter $adapter)
    {
        $this->assertTrue($adapter->has('factory'));
    }

    /**
     * @depends testCanBeConstructedFromContainer
     */
    public function testSingletonEntryCanBeFound(ContainerAdapter $adapter)
    {
        $this->assertTrue($adapter->has('singleton'));
    }

    /**
     * @depends testCanBeConstructedFromContainer
     */
    public function testEntryForExistingClassCanBeFound(ContainerAdapter $adapter)
    {
        $this->assertTrue($adapter->has('stdClass'));
    }

    /**
     * @depends testCanBeConstructedFromContainer
     */
    public function testMissingEntryCannotBeFound(ContainerAdapter $adapter)
    {
        $this->assertFalse($adapter->has('missing'));
    }
}
