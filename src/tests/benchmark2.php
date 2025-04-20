<?php
namespace tandrezone\Aitools\tests;

use tandrezone\Aitools\Utils\Templates;
use tandrezone\Aitools\Utils\Validators;
use tandrezone\Aitools\modelBridges\Ollama;

class benchmark {
    public function start() {
        
$ollama = new Ollama();

$models = $ollama->getModels()['models'];
echo "List of models available:" . PHP_EOL;
$modelsPASS = [];
foreach ($models as $model) {
    echo $model['name'] . PHP_EOL;
    $modelsPASS[$model['name']] = 1;
}

$parameters = [];
$parameters[]['workdetails'] = ['worked on ticket 1, worked on ticket 2'];
$parameters[]['workdetails'] = ['did research on ticket 1, did research on ticket 2'];

foreach ($models as $model) {
    echo PHP_EOL;
    $time = time();
    print_r($model);
    $modelSelected = $model['name'];

    echo PHP_EOL;
    $ollama->setModel($modelSelected);

    foreach ($parameters as $parameter) {
        echo PHP_EOL;

        echo $parameter['prompt'] . PHP_EOL;
        $response = $ollama->getRaw(Templates::get('worklog'), $parameter)['response'];
        print_r($response);
        echo PHP_EOL;
        $trimmed = trim($response);
        $trimmed = trim($trimmed, '"');
        if(!Validators::validate($trimmed)){
            var_dump($trimmed);
            unset($modelsPASS[$modelSelected]);
            break;
        } else {
            echo "Valid JSON response" . PHP_EOL;
        }

    }
    echo PHP_EOL;
    if(isset($modelsPASS[$modelSelected])){
        $modelsPASS[$modelSelected] = time() - $time;

    }
    echo "time running: " . time() - $time . "sec" . PHP_EOL;
    echo "----------------------------------------" . PHP_EOL;
    }
    echo "Models that passed the test:" . PHP_EOL;
    foreach ($modelsPASS as $model => $value) {
        echo $model ."=>".$value." sec". PHP_EOL;
    }

}

}