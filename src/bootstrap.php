<?php
require_once __DIR__ . '/../vendor/autoload.php';
use tandrezone\Aitools\modelBridges\Ollama; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

$ollama = new Ollama();

$models = $ollama->getModels()['models'];
echo "List of models available:" . PHP_EOL;
$modelsPASS = [];
foreach ($models as $model) {
    echo $model['name'] . PHP_EOL;
    $modelsPASS[$model['name']] = 1;
}
$ollama->setModel("mistral-small3.1");
print_r($ollama->getRaw("{{prompt}}", ["prompt" => "What is the capital of France?",'stream' => false]));
#$benchmark->start();