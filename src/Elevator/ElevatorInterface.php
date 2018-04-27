<?php

use Elevator\State\AbstractState;

/**
 * Interface ElevatorInterface
 */
interface ElevatorInterface
{
    /**
     * @param int $floor
     */
    public function move(int $floor);

    /**
     * @param int $floor
     */
    public function pushCallButton(int $floor);

    /**
     * @param int $floor
     */
    public function pushDestinationButton(int $floor);

    /**
     * @param AbstractState $state
     */
    public function changeState(AbstractState $state);
}
