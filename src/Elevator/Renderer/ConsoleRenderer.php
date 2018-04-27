<?php

namespace Elevator\Renderer;

/**
 * Class ConsoleRenderer
 */
class ConsoleRenderer implements RendererInterface
{
    /**
     * @param array $content
     */
    public function render(array $content)
    {
        foreach ($content as $row) {
            echo $row.PHP_EOL;
            sleep(1); // fore more user friendly
        }
    }
}
