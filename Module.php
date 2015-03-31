<?php
namespace T4webTimeline;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\Mvc\Controller\ControllerManager;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapterInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\View\HelperPluginManager;
use T4webBase\Domain\Service\Create as ServiceCreate;
use T4webBase\Domain\Service\BaseFinder as ServiceFinder;
use T4webTimeline\Controller\Console\InitController;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface,
                        ControllerProviderInterface, ConsoleUsageProviderInterface,
                        ServiceProviderInterface, ViewHelperProviderInterface
{

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
                'T4webTimeline\Entry\Service\Create' => function (ServiceManager $sm) {
                    return new ServiceCreate(
                        $sm->get('T4webTimeline\Entry\InputFilter\Create'),
                        $sm->get('T4webTimeline\Entry\Repository\DbRepository'),
                        $sm->get('T4webTimeline\Entry\Factory\EntityFactory')
                    );
                },

                'T4webTimeline\Entry\Service\Finder' => function (ServiceManager $sm) {
                    return new ServiceFinder(
                        $sm->get('T4webTimeline\Entry\Repository\DbRepository'),
                        $sm->get('T4webTimeline\Entry\Criteria\CriteriaFactory')
                    );
                },
            ),
            'invokables' => array(
                'T4webTimeline\Controller\User\ListViewModel' => 'T4webTimeline\Controller\User\ListViewModel',

                'T4webTimeline\Entry\InputFilter\Create' => 'T4webTimeline\Entry\InputFilter\Create',
                'T4webTimeline\View\Helper\TimelineViewModel' => 'T4webTimeline\View\Helper\TimelineViewModel',
            ),
        );
    }

    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'T4webTimeline\Controller\Console\Init' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    return new InitController(
                        $sl->get('Zend\Db\Adapter\Adapter')
                    );
                },
                'T4webTimeline\Controller\User\List' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    return new Controller\User\ListController(
                        $sl->get('T4webTimeline\Entry\Service\Finder'),
                        $sl->get('T4webTimeline\Controller\User\ListViewModel')
                    );
                },
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'timeline' => function (HelperPluginManager $pluginManager) {
                    $sl = $pluginManager->getServiceLocator();
                    $eventManager = $sl->get('EventManager');
                    $eventManager->addIdentifiers('T4webTimeline\View\Helper\Timeline');

                    return new View\Helper\Timeline(
                        $sl->get('T4webTimeline\Entry\Service\Finder'),
                        $sl->get('T4webTimeline\View\Helper\TimelineViewModel'),
                        $eventManager
                    );
                },
            ),
        );
    }
}
