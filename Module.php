<?php
namespace Timeline;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\Controller\ControllerManager;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapterInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\EventManager\EventInterface;
use Timeline\Controller\Console\InitController;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface,
                        ControllerProviderInterface, ConsoleUsageProviderInterface,
                        ServiceProviderInterface, BootstrapListenerInterface
{
    public function onBootstrap(EventInterface $e)
    {
        $em  = $e->getApplication()->getEventManager();
        $sm  = $e->getApplication()->getServiceManager();

        $employeesListener = $sm->get('Timeline\Listener\Employees');
        $employeesListener->attach($em);
    }

    public function getConfig($env = null)
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConsoleUsage(ConsoleAdapterInterface $console)
    {
        return array(
            'timeline init' => 'Initialize module',
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Timeline\Listener\Employees' => function(ServiceManager $sm) {
                    return new Listener\Employees(
                    );
                },
            ),
            'invokables' => array(
            ),
        );
    }

    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'Timeline\Controller\Console\Init' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    return new InitController(
                        $sl->get('Zend\Db\Adapter\Adapter')
                    );
                },
            ),
        );
    }
}
