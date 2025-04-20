<?php
namespace tandrezone\Aitools\Utils;

class Validators {
    CONST VALIDATORS = [
        'catchPhrase'=> __DIR__ . '/../Templates/catchPhrase.template'
    ];

    public static function validate($response) {
        if(!json_validate($response)){
            var_dump($response);
            echo "Invalid JSON response";
            return false;
        }
        return true;
    }
    
}