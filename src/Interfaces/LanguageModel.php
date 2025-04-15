<?php
namespace tandrezone\Aitools\Interfaces;
interface LanguageModel {
    /**
     * Generates text based on the given prompt.
     * 
     * @param string $prompt The input prompt for generating text.
     * @return string Generated text.
     */
    public function generateText(string $prompt): string;

    /**
     * Completes a sentence or paragraph based on the given context.
     * 
     * @param string $context The initial text to build upon.
     * @param int $maxTokens Maximum number of tokens (words) in the generated text.
     * @return string Generated completion.
     */
    public function completeText(string $context, int $maxTokens): string;

    /**
     * Summarizes the given text.
     * 
     * @param string $text The input text to summarize.
     * @param int $maxTokens Maximum number of tokens in the summary.
     * @return string Summary of the text.
     */
    public function summarize(string $text, int $maxTokens): string;

    /**
     * Translates the given text from one language to another.
     * 
     * @param string $text The input text to be translated.
     * @param string $sourceLang Source language code (e.g., 'en' for English).
     * @param string $targetLang Target language code (e.g., 'es' for Spanish).
     * @return string Translated text.
     */
    public function translate(string $text, string $sourceLang, string $targetLang): string;

    /**
     * Determines the sentiment of the given text.
     * 
     * @param string $text The input text to analyze for sentiment.
     * @return string Sentiment analysis result (e.g., 'positive', 'negative', 'neutral').
     */
    public function analyzeSentiment(string $text): string;
}
