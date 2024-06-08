<?php

use Dotenv\Dotenv;

require 'vendor/autoload.php';

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

// echo getenv('TEST');