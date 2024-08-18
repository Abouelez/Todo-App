<?php

use Dotenv\Dotenv;
use Src\config;
use Src\config\Database;
use Src\core\Route;
use Src\Models\Task;

require 'vendor/autoload.php';

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

// echo getenv('TEST');

// $db = Database::getInstance()->getConnection();

// var_dump($db);

// Task::delete(1);
// print_r(Task::find(1));