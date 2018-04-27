<?php

namespace Elevator\State;

/**
 * Class WaitingState
 */
class WaitingState extends AbstractState
{
    /**
     *
     */
    public function afterArrived()
    {
        if (!empty($this->elevator->callStack)) {
            $this->elevator->changeState(new MovingToCallState($this->elevator));
            $this->elevator->move((int) array_shift($this->elevator->callStack));
        } else {
            $this->elevator->changeState(new ReadyState($this->elevator));
        }
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
        // move the elevator or add to the destination stack
        $this->elevator->changeState(new MovingToDestinationState($this->elevator));
        $this->elevator->move($floor);
    }
}
