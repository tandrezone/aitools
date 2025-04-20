<?php
namespace tandrezone\Aitools\Utils;

class Templates {
    CONST TEMPLATES = [
        'catchPhrase'=> __DIR__ . '/../Templates/catchPhrase.template',
        'worklog'=> __DIR__ . '/../Templates/worklog.template'
    ];

    public static function get($templateName) {
        return file_get_contents(self::TEMPLATES[$templateName]);
    }

    public static function getparameters($template) {
        preg_match_all('/{{(.*?)}}/', $template, $correspondencias);
        return $correspondencias[1]; // Retorna apenas o conteúdo entre as chaves
    }
    
}