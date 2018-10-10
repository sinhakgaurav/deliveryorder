<?php
// Root path for inclusion.
define('INC_ROOT', dirname(__DIR__));

$_ENV['orderStatusArray'] = [
        'unassigned' => '0',
        'taken' => '1',
        'success' => '2',
    ];
$_ENV['allowedRequest'] = [
        'PUT',
        'POST',
        'GET',
    ];
$_ENV['not_required'] = ['token'];

// Require composer autoloader
require_once INC_ROOT . '/vendor/autoload.php';

//loading configs
$dotenv = new Dotenv();
$dotenv->load(INC_ROOT . '/app/config');

\Core\Container::loadDependency();
