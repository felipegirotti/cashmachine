<?php

namespace Tests\AppBundle\EventListener;

use Careship\AppBundle\EventListener\ExceptionListener;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Tests\TestHttpKernel;

class ExceptionListenerTest extends TestCase
{

    /**
     * @param GetResponseForExceptionEvent $event
     * @param int $httpCode
     * @dataProvider onKernelExceptionDataProvider
     */
    public function testOnKernelException(GetResponseForExceptionEvent $event, int $httpCode)
    {
        $listener = new ExceptionListener();
        $listener->onKernelException($event);

        $this->assertEquals($httpCode, $event->getResponse()->getStatusCode());
    }

    /**
     * @return array
     */
    public function onKernelExceptionDataProvider()
    {
        return [
            [new GetResponseForExceptionEvent(new TestHttpKernel(), new Request(), 1, new \Exception('error')), 500],
            [new GetResponseForExceptionEvent(new TestHttpKernel(), new Request(), 1, new \InvalidArgumentException('error')), 400],
        ];
    }
}
