<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();
$ollama = new tandrezone\Aitools\modelBridges\Ollama();
use tandrezone\Aitools\Utils\Templates;
$models = $ollama->getModels()['models'];
echo "List of models available:" . PHP_EOL;
foreach ($models as $model) {
    echo $model['name'] . PHP_EOL;
}

$parameters = [];
$parameters[] = [
    'prompt' => '"The Spring water bottle is an absolute bestseller. The bottle is made of Eastman Tritan™, which means it is BPA-free, light, durable and impact-resistant. The bottle is single-walled, holds 600 ml of liquid, and the stainless steel twist-on lid ensures easy opening and closing. Besides all, the Spring bottle offers enough space for adding any wanted logo or other messages."',
    'chars' => 80,
    'number_phrases' => 2
];
$parameters[] = [
    'prompt' => '"Staying hydrated at all times is possible with this durable yet lightweight 400 ml aluminium water bottle. It is the perfect companion while exercising, on day trips or at the office. The single wall Oregon bottle has a twist-on lid and offers plenty of space to add any kind of logo. Clip the attached carabiner (not suitable for climbing) securely to a bag to avoid losing it. BPA Free and tested and approved under German Food Safe Legislation (LFGB) and for phthalates content under  REACH."',
    'chars' => 80,
    'number_phrases' => 2
];
$parameters[] = [
    'prompt' => '"Exclusive design sunglasses category 3 lenses with UV 400 protection, includes hardcase box and cleaning cloth. Packed in a Slazenger gift box. Cupronickel frame and polycarbonate lenses."',
    'chars' => 80,
    'number_phrases' => 2
];
$parameters[] = [
    'prompt' => '"Nordic telescopic walking sticks with easy grip, comfortable wrist straps and changeable tips. Pouch included."',
    'chars' => 80,
    'number_phrases' => 2
];
$parameters[] = [
    'prompt' => '"Original Slazenger football with enough imprint space to fit any logo. 3 layers. Size 5. Packed in a polybag with printed manual. Exclusive design."',
    'chars' => 80,
    'number_phrases' => 2
];
$parameters[] = [
    'prompt' => '"Cool-looking sunglasses with category 3 lenses and a soft pouch with drawstring closure. Compliant with EN ISO 12312-1 and UV 400."',
    'chars' => 80,
    'number_phrases' => 2
];
$parameters[] = [
    'prompt' => '"Picnic blanket with water resistant backing with easy carry handle. Blanket size is 145 x 130 cm."',
    'chars' => 80,
    'number_phrases' => 2
];
$parameters[] = [
    'prompt' => '"Sending someone a needed hug is easy with the Huggy plaid blanket of 150 x 120 cm. The single colour plaid blanket is made of 100% polar fleece 200 g/m², a soft and comfortable material that quickly provides the necessary warmth and retains body heat. Roll up the blanket and tuck it into the handy pouch with a drawstring closure for easy storage without losing much space."',
    'chars' => 80,
    'number_phrases' => 2
];
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
        print_r($ollama->getRaw(Templates::get('catchPhrase'), $parameter)['response']);
        echo PHP_EOL;
    }
    echo PHP_EOL;
    echo "time running: " . time() - $time . "sec" . PHP_EOL;
    echo "----------------------------------------" . PHP_EOL;
}