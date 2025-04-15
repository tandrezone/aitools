<?php
namespace tandrezone\Aitools\modelBridges;

use tandrezone\Aitools\Interfaces\LanguageModel;
class Ollama implements LanguageModel {
    private String $model;
    public function __construct($model) {
        $this->model = $model;    
    }

    /**
     * Generates text based on the given prompt.
     */ 
    public function generateText(string $prompt): string {
        // Implementation to call Ollama API for generating text
        return $this->callOllamaAPI('generate', ['prompt' => $prompt]);
    }

    /**
     * Completes a sentence or paragraph based on the given context.
     */
    public function completeText(string $context, int $maxTokens): string {
        // Implementation to call Ollama API for completing text
        return $this->callOllamaAPI('complete', ['context' => $context, 'max_tokens' => $maxTokens]);
    }

    /**
     * Summarizes the given text.
     */
    public function summarize(string $text, int $maxTokens): string {
        // Implementation to call Ollama API for summarizing text
        return $this->callOllamaAPI('summarize', ['text' => $text, 'max_tokens' => $maxTokens]);
    }

    /**
     * Translates the given text from one language to another.
     */
    public function translate(string $text, string $sourceLang, string $targetLang): string {
        // Implementation to call Ollama API for translating text
        return $this->callOllamaAPI('translate', ['text' => $text, 'source_lang' => $sourceLang, 'target_lang' => $targetLang]);
    }

    /**
     * Determines the sentiment of the given text.
     */
    public function analyzeSentiment(string $text): string {
        // Implementation to call Ollama API for analyzing sentiment
        return $this->callOllamaAPI('sentiment', ['text' => $text]);
    }

    /**
     * Calls the Ollama API.
     */
    private function callOllamaAPI(string $endpoint, array $params): string {
        $params['model'] = $this->model;
        // Construct URL or other parameters for the API request
        $url = getenv('OLLAMA_ENDPOINT') . $endpoint;
        $options = [
            'http' => [                'method'  => 'POST',
                'content' => json_encode($params),
            ],
        ];
        
        // Send the request and get the response
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        
        if ($response === FALSE) {
            throw new \Exception("Error Communicating with Ollama API");
        }
        print_r($response);
        
        return json_decode($response, true)['result'] ?? '';
    }
}
