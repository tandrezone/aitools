<?php
require "vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/..");
$dotenv->load();
$ollama = new tandrezone\Aitools\modelBridges\Ollama('gemma2:2b');
$models = $ollama->getModels()['models'];
foreach($models as $model) {
    echo $model['name']."\n";
}
print_r($ollama->getCatchPhrase("The Spring water bottle is an absolute bestseller. The bottle is made of Eastman Tritan™, which means it is BPA-free, light, durable and impact-resistant. The bottle is single-walled, holds 600 ml of liquid, and the stainless steel twist-on lid ensures easy opening and closing. Besides all, the Spring bottle offers enough space for adding any wanted logo or other messages.", 80,2)['response']);