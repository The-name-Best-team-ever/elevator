<?php

namespace Elevator\State;

use \Elevator\Elevator;

/**
 * Class AbstractState
 */
abstract class AbstractState
{
    /** @var Elevator */
    protected $elevator;

    /**
     * @param Elevator $elevator
     */
    public function __construct(Elevator $elevator)
    {
        $this->elevator = $elevator;
    }

    /**
     * @param int $floor
     */
    abstract public function pushCallButton(int $floor);

    /**
     * @param int $floor
     */
    abstract public function pushDestinationButton(int $floor);

    /**
     */
    abstract public function  afterArrived();
}
