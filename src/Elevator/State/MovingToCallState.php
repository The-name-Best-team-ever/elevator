<?php

namespace Elevator\State;

use Elevator\Elevator;

/**
 * Class MovingToCallState
 */
class MovingToCallState extends AbstractState
{
    /**
     * @param Elevator $elevator
     */
    public function __construct(Elevator $elevator)
    {
        parent::__construct($elevator);
        $this->elevator->setBusy(true);
    }

    /**
     *
     */
    public function afterArrived()
    {
        $this->elevator->changeState(new WaitingState($this->elevator));
    }

    /**
     * @param int $floor
     */
    public function pushCallButton(int $floor)
    {
        if ($this->elevator->canAddToCallStack()) {
            $this->elevator->callStack[] = $floor;
        }
    }

    /**
     * @param int $floor
     */
    public function pushDestinationButton(int $floor)
    {
        // do no thing
        // there is no one on cabin
    }
}
