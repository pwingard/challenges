<?php
//codility code challenge: read challenge.md for task detail

namespace TDD;

require_once 'src/Counter.php';

$Counter = new Counter();

$Counter->TurnOnErrorReporting();

$Counter->counter_size = 5;//N
$Counter->command_arr_A = array(3,4,4,6,1,4,4);//A

$Counter->CreateCounterArr();
$Counter->CycleCounterInputs();
$Counter->DisplayOutput();

echo $Counter->output.PHP_EOL;
