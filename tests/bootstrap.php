<?php

use Symfony\Component\Dotenv\Dotenv;

define('PROJECT_ROOT', dirname(__DIR__) . '/');

if(file_exists('config/bootstrap.php')){
    require 'config/bootstrap.php';
}

//@todo: symfony by default does not override variables from .env.test
// (e.g. if we set DATABASE_NAME in both .env and .env.test, value from .env is used)
// So here we overload them
$dotenv = new Dotenv();

// sorted array of .env files. later has precedence
$testEnvFiles = ['.env.test'];

$testEnvFiles = array_filter($testEnvFiles, function ($filename) {
    return file_exists(PROJECT_ROOT.$filename);
});

if (count($testEnvFiles)) {
    $dotenv->overload(...$testEnvFiles);
}

