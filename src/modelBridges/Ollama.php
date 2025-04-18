<?php
namespace tandrezone\Aitools\modelBridges;

use tandrezone\Aitools\Interfaces\LanguageModel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
class Ollama
{
    private string $model;
    private Client $client;
    private string $apiUrl;

    private array $options;

    public function __construct()
    {
        $this->model = "";
        $this->options = [];
        $this->apiUrl = "http://127.0.0.1:11434/api/";

        $this->client = new Client([
            'base_uri' => $this->apiUrl,
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ]);
    }
    public function setModel(string $model)
    {
        $this->model = $model;
    }

    /**
     * Lists all available models.
     */
    public function getModels(): array
    {
        return $this->callOllamaAPI('tags', []);
    }

    /**
     * Generates text based on the given template and parameters.
     */
    public function getRaw($template, $parameters): array
    {
        foreach ($parameters as $key => $value) {
            $template = str_replace('{{' . $key . '}}', $value, $template);
        }
        return $this->callModelAPI('generate', ['prompt' => $template, 'stream' => false]);
    }

    /**
     * Generates text based on the given prompt.
     */
    public function generateText(string $prompt): array
    {
        // Implementation to call Ollama API for generating text
        return $this->callModelAPI('generate', ['prompt' => $prompt, 'stream' => false]);
    }

    /**
     * Completes a sentence or paragraph based on the given context.
     */
    public function completeText(string $context, int $maxTokens): array
    {
        // Implementation to call Ollama API for completing text
        return $this->callModelAPI('complete', ['context' => $context, 'max_tokens' => $maxTokens]);
    }

    /**
     * Summarizes the given text.
     */
    public function summarize(string $text, int $maxTokens): array
    {
        // Implementation to call Ollama API for summarizing text
        return $this->callModelAPI('summarize', ['text' => $text, 'max_tokens' => $maxTokens]);
    }

    /**
     * Translates the given text from one language to another.
     */
    public function translate(string $text, string $sourceLang, string $targetLang): array
    {
        // Implementation to call Ollama API for translating text
        return $this->callModelAPI('translate', ['text' => $text, 'source_lang' => $sourceLang, 'target_lang' => $targetLang]);
    }


    /**
     * Calls the Ollama API.
     */
    private function callModelAPI(string $endpoint, array $params = [], $http_method = 'POST'): array
    {
        if (!$this->model) {
            throw new \Exception('Model not set.');
        }
        if (!empty($this->options)) {
            $params['options'] = $this->options;
        }
        $params['model'] = $this->model;
        // Construct URL or other parameters for the API request
        return $this->callOllamaAPI($endpoint, $params, $http_method);

    }

    /**
     * Handles API request and response.
     */
    private function callOllamaAPI(string $endpoint, array $params = [], $http_method = 'GET')
    {
        try {
            if ($http_method == 'GET') {
                $response = $this->client->get($endpoint);
            } else {
                $response = $this->client->post($endpoint, ['json' => $params]);
            }
            $data = json_decode($response->getBody(), true);
            return $data;
        } catch (RequestException $e) {
            echo 'API Request failed: ' . $e->getMessage();

            error_log('API Request failed: ' . $e->getMessage());
            exit();
        }
    }
}
