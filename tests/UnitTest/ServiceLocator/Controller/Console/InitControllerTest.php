<?php
namespace TimelineTest\UnitTest\ServiceLocator\Controller\Console;

require_once dirname(__DIR__) . "/ControllerManagerAwareTrait.php";
use TimelineTest\UnitTest\ServiceLocator\Controller\ControllerManagerAwareTrait;

class InitControllerTest extends \PHPUnit_Framework_TestCase
{
    use ControllerManagerAwareTrait;

    public function testCreation()
    {
        $dbAdapterMock = $this->getMockBuilder('Zend\Db\Adapter\Adapter')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('Zend\Db\Adapter\Adapter', $dbAdapterMock);

        $this->assertTrue($this->controllerManager->has('Timeline\Controller\Console\Init'));

        $controller = $this->controllerManager->get('Timeline\Controller\Console\Init');

        $this->assertInstanceOf('Timeline\Controller\Console\InitController', $controller);

        $this->assertAttributeEquals($dbAdapterMock, 'dbAdapter', $controller);
    }

}