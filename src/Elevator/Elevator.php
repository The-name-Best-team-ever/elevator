<?php

namespace Elevator;

use Elevator\Renderer\RendererInterface;
use Elevator\State\AbstractState;
use Elevator\State\ReadyState;

class Elevator
{
    /** @var Elevator */
    private static $instance;

    /** @var Configuration */
    private $configuration;

    /** @var AbstractState */
    private $state;

    /** @var array */
    public $callStack = [];

    /** @var int */
    private $currentFloor;

    /** @var bool */
    private $elevatorBusy;

    private $direction;

    /** @var RendererInterface */
    public $renderer;

    /**
     * @param RendererInterface $renderer
     */
    private function __construct(RendererInterface $renderer)
    {
        $this->configuration = new Configuration();
        $this->state = new ReadyState($this);
        $this->currentFloor = 1;
        $this->renderer = $renderer;
        $this->elevatorBusy = false;
    }

    /**
     * @param RendererInterface $renderer
     * @return Elevator
     */
    public static function getInstance(RendererInterface $renderer)
    {
        if (null === self::$instance) {
            self::$instance = new Elevator($renderer);
        }

        return self::$instance;
    }

    /**
     * @param int $floor
     */
    public function pushCallButton(int $floor)
    {
        $this->state->pushCallButton($floor);
    }

    /**
     * @param int $floor
     */
    public function pushDestination(int $floor)
    {
        $this->state->pushDestinationButton($floor);
    }

    /**
     * @param AbstractState $state
     * @return $this
     */
    public function changeState(AbstractState $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @param int $floor
     */
    public function move(int $floor)
    {
        while ($floor !== $this->currentFloor) {

            if ($floor > $this->currentFloor) {
                $this->currentFloor++;
            } else {
                $this->currentFloor--;
            }

            $this->renderer->render(['...']);

            sleep(1);

            if ($floor !== $this->currentFloor) {
                $this->renderer->render([$this->currentFloor.' floor']);
            } else {
                $this->renderer->render(['*Dzin*', $this->currentFloor.' floor']);
            }
        }

        $this->state->afterArrived();
    }

    /**
     * @return int
     */
    public function getCurrentFloor()
    {
        return $this->currentFloor;
    }

    /**
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function setBusy(bool $status)
    {
        $this->elevatorBusy = $status;

        return $this;
    }

    /**
     * @param int $floor
     * @return $this
     */
    public function setCurrentFloor(int $floor)
    {
        $this->currentFloor = $floor;

        return $this;
    }

    /**
     * @return Elevator
     */
    public function goOut()
    {
        return $this->changeState(new ReadyState($this));
    }

    /**
     * @param int $floor
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function floorAvailable(int $floor)
    {
        if ($this->configuration::LOWEST_FLORE > $floor) {
            throw new \InvalidArgumentException('Can\'t be lower than '.$this->configuration::LOWEST_FLORE);
        }

        if ($this->configuration::HIGHEST_FLORE < $floor) {
            throw new \InvalidArgumentException('Can\'t be higher than '.$this->configuration::HIGHEST_FLORE);
        }

        return true;
    }

    /**
     * @return bool
     */
    public function canGoTo()
    {
        if ($this->elevatorBusy) {

            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function canAddToCallStack()
    {
        return \count($this->callStack) < $this->configuration::MAX_CALLS_SIZE;
    }
}
