<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\MagentoCloud\Test\Unit\Http;

use Magento\MagentoCloud\Http\RequestFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use PHPUnit_Framework_MockObject_MockObject as Mock;

/**
 * @inheritdoc
 */
class RequestFactoryTest extends TestCase
{
    /**
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * @var ContainerInterface|Mock
     */
    private $containerMock;

    /**
     * @var RequestInterface
     */
    private $requestMock;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->containerMock = $this->getMockBuilder(ContainerInterface::class)
            ->setMethods(['create'])
            ->getMockForAbstractClass();
        $this->requestMock = $this->getMockForAbstractClass(RequestInterface::class);

        $this->requestFactory = new RequestFactory(
            $this->containerMock
        );
    }

    public function testCreate()
    {
        $this->containerMock->expects($this->once())
            ->method('create')
            ->willReturn($this->requestMock);

        $this->assertInstanceOf(
            RequestInterface::class,
            $this->requestFactory->create('GET', 'some_uri')
        );
    }
}