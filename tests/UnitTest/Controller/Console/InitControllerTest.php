<?php
namespace EmployeesTest\UnitTest\Controller\Console;

use Timeline\Controller\Console\InitController;

class InitControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testRun()
    {
        $dbAdapterMock = $this->getMockBuilder('Zend\Db\Adapter\Adapter')
            ->disableOriginalConstructor()
            ->getMock();

        $controller = new InitController($dbAdapterMock);

        $dbAdapterMock->expects($this->any())
            ->method('query');

        $dbAdapterMock->expects($this->any())
            ->method('getPlatform')
            ->will($this->returnValue($this->getMock('Zend\Db\Adapter\Platform\Mysql')));

        $controller->runAction();

        $this->assertAttributeEquals($dbAdapterMock, 'dbAdapter', $controller);
    }

}