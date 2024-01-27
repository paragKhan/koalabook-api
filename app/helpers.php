<?php

use Symfony\Component\Console\Output\ConsoleOutput;

if (!function_exists('cout')) {
    function cout($output)
    {
        $console = new ConsoleOutput();
        $console->write(json_encode($output));
    }
}
