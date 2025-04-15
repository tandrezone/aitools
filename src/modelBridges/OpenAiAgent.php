<?php
namespace tandrezone\Aitools\modelBridges;

use tandrezone\Aitools\Interfaces\AIInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class OpenAIAgent implements AIInterface {
    private $client;
    private $apiKey;
    private $apiUrl = 'https://api.openai.com/v1/chat/completions';

    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => $this->apiUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    private function callAPI(string $systemPrompt, string $userPrompt): string {
        $body = [
            'model' => 'gpt-4', // or 'gpt-3.5-turbo'
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $userPrompt]
            ],
            'temperature' => 0.7
        ];

        try {
            $response = $this->client->post('', ['json' => $body]);
            $data = json_decode($response->getBody(), true);
            return $data['choices'][0]['message']['content'] ?? 'No response.';
        } catch (RequestException $e) {
            return 'API Request failed: ' . $e->getMessage();
        }
    }

    public function generateText(string $prompt): string {
        return $this->callAPI("You are a helpful assistant that generates text.", $prompt);
    }

    public function summarizeText(string $text): string {
        $prompt = "Please summarize the following text:\n\n$text";
        return $this->callAPI("You are a summarization assistant.", $prompt);
    }

    public function translate(string $text, string $targetLanguage): string {
        $prompt = "Translate the following text to $targetLanguage:\n\n$text";
        return $this->callAPI("You are a translation assistant.", $prompt);
    }

    public function analyzeSentiment(string $text): string {
        $prompt = "Analyze the sentiment of this text and respond only with 'positive', 'neutral', or 'negative':\n\n$text";
        return trim($this->callAPI("You are a sentiment analysis tool.", $prompt));
    }

    public function answerQuestion(string $question, string $context = ''): string {
        $prompt = !empty($context) ? "Context: $context\n\nQuestion: $question" : $question;
        re
turn $this->callAPI("You are an expert assistant answering questions.", $prompt);
    }
}