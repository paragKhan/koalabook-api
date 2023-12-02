<?php

use Symfony\Component\Console\Output\ConsoleOutput;

if (!function_exists('cout')){
    function cout($output){
        $console = new ConsoleOutput();
        $console->writeln(json_encode($output));
    }
}
