<?php

// Carrega o autoload do Composer
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Chama o roteador principal
require_once __DIR__ . '/src/router.php';
