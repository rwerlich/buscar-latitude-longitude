<?php

use \App\controllers\MapsController;

$app->post('/api/find', 'App\Controllers\MapsController::create');
$app->get('/api/list', 'App\Controllers\MapsController::list');
