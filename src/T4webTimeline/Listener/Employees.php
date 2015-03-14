<?php

namespace T4webTimeline\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\Event;

class Employees implements ListenerAggregateInterface {

    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();

    public function __construct() {

    }

    /**
     * Attach to an event manager
     *
     * @param  EventManagerInterface $events
     * @param  int $priority
     */
    public function attach(EventManagerInterface $events, $priority = 1) {
        $this->listeners[] = $events->getSharedManager()
                ->attach(
                        'T4webEmployees\Employee\Service\Create',
                        'create:post',
                        array($this, 'onEmployeeCreate'),
                        $priority
                );
    }

    /**
     * Detach all our listeners from the event manager
     *
     * @param  EventManagerInterface $events
     * @return void
     */
    public function detach(EventManagerInterface $events) {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * @param  Event $e
     * @return null
     */
    public function onEmployeeCreate(Event $e) {
        $employee = $e->getParam('entity');

        die(var_dump(__METHOD__, $employee));
    }
}
