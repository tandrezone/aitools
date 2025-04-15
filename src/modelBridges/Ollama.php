<?php
namespace tandrezone\Aitools\modelBridges;

use tandrezone\Aitools\Interfaces\LanguageModel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
class Ollama {
    private String $model;
    private Client $client;
    private String $apiUrl;

    public function __construct($model) {
        $this->model = $model;
        $this->apiUrl = "http://127.0.0.1:11434/api/";;

        $this->client = new Client([
            'base_uri' => $this->apiUrl,
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ]);
            
    }

    /**
     * Lists all available models.
     */ 
    public function getModels(): array {
        return $this->callOllamaAPI('tags',[], 'GET');
    }

    public function getCatchPhrase(string $description,int $chars,int $number_phrases,string $prompt='Create me {{number_phrases}} catch phrases maximum {{chars}} characters each for a product with this description: '): array {
        echo PHP_EOL.$description.PHP_EOL;
        $prompt = str_replace('{{chars}}', $chars, $prompt);
        $prompt = str_replace('{{number_phrases}}', $number_phrases, $prompt);
        $prompt = $prompt.' "'.$description.'" give me only the phrases, no other text and in json format, and without marks, neither markdown annotations, neither ```json, just the json array with the phrases';
        echo PHP_EOL;
        $params = [
            'prompt' => $prompt,
            'stream' => false
        ];
        return $this->callOllamaAPI('generate',$params);
    }
    /**
     * Generates text based on the given prompt.
     */ 
    public function generateText(string $prompt): array {
        // Implementation to call Ollama API for generating text
        return $this->callOllamaAPI('generate', ['prompt' => $prompt]);
    }

    /**
     * Completes a sentence or paragraph based on the given context.
     */
    public function completeText(string $context, int $maxTokens): array {
        // Implementation to call Ollama API for completing text
        return $this->callOllamaAPI('complete', ['context' => $context, 'max_tokens' => $maxTokens]);
    }

    /**
     * Summarizes the given text.
     */
    public function summarize(string $text, int $maxTokens): array {
        // Implementation to call Ollama API for summarizing text
        return $this->callOllamaAPI('summarize', ['text' => $text, 'max_tokens' => $maxTokens]);
    }

    /**
     * Translates the given text from one language to another.
     */
    public function translate(string $text, string $sourceLang, string $targetLang): array {
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
    private function callOllamaAPI(string $endpoint, array $params=[], $http_method = 'POST'): array {
        $params['model'] = $this->model;
        // Construct URL or other parameters for the API request
        

        try {
            if ($http_method == 'GET') {
                $response = $this->client->get($endpoint);
            } else {
                $response = $this->client->post($endpoint, ['json' => $params]);
            }
            $data = json_decode($response->getBody(), true);
            return $data;
        } catch (RequestException $e) {
            return 'API Request failed: ' . $e->getMessage();
        }
        
    }
}
