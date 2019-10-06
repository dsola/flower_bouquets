#!/usr/bin/php
<?php

require __DIR__ . '/vendor/autoload.php';

use Solaing\FlowerBouquets\GenerateBouquets;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

$input = new ArgvInput();
$input->setStream(fopen(__DIR__.'/resources/' . $input->getFirstArgument(), 'r'));
$output = new ConsoleOutput();

(new GenerateBouquets($input, $output))->exec();

?>