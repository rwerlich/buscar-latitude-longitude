<?php

require 'config.php';

foreach (glob(__DIR__.'/routes/*.php') as $filename) {
    require $filename;
}

$app->run();
