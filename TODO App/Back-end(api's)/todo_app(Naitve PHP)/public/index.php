<?php

use Core\Route;
use App\Controllers\TaskController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../bootstrap.php';


Route::get('/test', [TaskController::class, 'insert']);

Route::resolve();
