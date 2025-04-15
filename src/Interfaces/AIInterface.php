<?php
namespace tandrezone\Aitools\Interfaces;

interface AIInterface {
    /**
     * Generates a text response based on input.
     *
     * @param string $prompt The input prompt.
     * @return string The generated response.
     */
    public function generateText(string $prompt): string;

    /**
     * Summarizes the provided text.
     *
     * @param string $text The full text to summarize.
     * @return string The summary.
     */
    public function summarizeText(string $text): string;

    /**
     * Translates text from one language to another.
     *
     * @param string $text The text to translate.
     * @param string $targetLanguage Language code (e.g., 'en', 'fr').
     * @return string The translated text.
     */
    public function translate(string $text, string $targetLanguage): string;

    /**
     * Analyzes sentiment of given text.
     *
     * @param string $text The text to analyze.
     * @return string One of 'positive', 'neutral', or 'negative'.
     */
    public function analyzeSentiment(string $text): string;

    /**
     * Answers a question based on given context.
     *
     * @param string $question The question to answer.
     * @param string $context Optional additional context or data.
     * @return string The answer.
     */
    public function answerQuestion(string $question, string $context = ''): string;
}

?