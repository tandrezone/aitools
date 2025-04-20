<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

$benchmark = new tandrezone\Aitools\tests\benchmark();
$benchmark->start();