<?php
require "vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$ollama = new tandrezone\Aitools\modelBridges\Ollama('mistral');
echo $ollama->generateText("iadeusclear");