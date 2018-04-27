<?php

namespace Elevator\State;

use Elevator\Elevator;

/**
 * Class ReadyState
 */
class ReadyState extends AbstractState
{
    /**
     * @param Elevator $elevator
     */
    public function __construct(Elevator $elevator)
    {
        parent::__construct($elevator);
        $this->elevator->setBusy(false);
    }

    /**
     *
     */
    public function afterArrived()
    {
        // do nothing
    }

    /**
     * @param int $floor
     */
    public function pushCallButton(int $floor)
    {
        if ($this->elevator->floorAvailable($floor)) {
            if ($this->elevator->canGoTo()) {
                $this->elevator->changeState(new MovingToCallState($this->elevator));
                $this->elevator->setBusy(true);
                $this->elevator->move($floor);
            } else {
                if ($this->elevator->canAddToCallStack()) {
                    $this->elevator->callStack[] = $floor;
                }
            }
        }
    }

    /**
     * @param int $floor
     */
    public function pushDestinationButton(int $floor)
    {
        // do nothing
        // there is no way to push the destination button if there is no one in the cabin
    }
}
