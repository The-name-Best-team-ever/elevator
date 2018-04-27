<?php

namespace Elevator;

use Elevator\Renderer\ConsoleRenderer;
use Elevator\Renderer\RendererInterface;

/**
 * Class Application
 */
class Application
{
    /** @var Elevator  */
    private $elevator;

    /** @var RendererInterface  */
    private $renderer;

    /**
     */
    public function __construct()
    {
        $this->renderer = new ConsoleRenderer();
        $this->elevator = Elevator::getInstance($this->renderer);
    }

    /**
     * Some user want to go from some floor to some another floor
     *
     * @param int $fromFloor
     * @param int $toFloor
     */
    public function goFromTo(int $fromFloor, int $toFloor)
    {
        $this->renderer->render(['Elevator on the '.$this->elevator->getCurrentFloor().' floor.']);
        $this->elevator->pushCallButton($fromFloor);
        $this->renderer->render(['Went to the elevator and pushed button '.$toFloor.'...']);
        $this->elevator->pushDestination($toFloor);
        $this->renderer->render(['Went out from the elevator on the '.$toFloor.' floor']);
    }
}
