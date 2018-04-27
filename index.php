<?php

use Elevator\Application;
use Elevator\Renderer\ConsoleRenderer;

// check if parameters are present
if (empty($argv[1])) {
    throw new \InvalidArgumentException('You didn\'t set "from" floor');
}

if (empty($argv[2])) {
    throw new \InvalidArgumentException('You didn\'t set "to" floor');
}

$fromFloor = $argv[1];
$toFloor = $argv[2];

include __DIR__.'/vendor/autoload.php';

$renderer = new ConsoleRenderer();

$renderer->render(['You are on the '.$fromFloor.' floor now, and want to go to the '.$toFloor.' floor.']);
$renderer->render(['Let\'s ride']);


$application = new Application();

$application->goFromTo($fromFloor, $toFloor);
