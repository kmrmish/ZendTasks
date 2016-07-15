<?php
/*
 * Example class for Event
 *
 */

namespace Checklist\Event;

use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

class Example implements EventManagerAwareInterface
{
    protected $events;

    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(array(
            __CLASS__,
            get_class($this)
        ));
        $this->events = $events;
    }

    public function getEventManager()
    {
        if (!$this->events) {
            $this->setEventManager(new EventManager());
        }
        return $this->events;
    }

    public function exampleDo($foo, $baz)
    {
        $params = compact('foo', 'baz');
        $this->getEventManager()->trigger(__FUNCTION__, $this, $params);
    }





}
