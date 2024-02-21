<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function translate(Request $request) {
        $textToTranslate = $request->input('text');
        $apiKey = 'APP_KEY';

        // send a request to the Translator Text API
        $translatedText = $this->translateText($textToTranslate, $apiKey);

        return response()->json([
            'translated_text' => $translatedText,
        ]);
    }

    public function translateText($text, $apiKey) {
        $client = new Client();
        $baseUrl = 'https://api.cognitive.microsofttranslator.com/translate';

        $headers = [
            'Ocp-Apim-Subscription-Key' => $apiKey,
            'Content-Type' => 'application/json',
        ];

        $detectedLanguage = $this->detectLanguage($text, $apiKey);

        $body = [
            [
                'text' => $text,
            ],
        ];

        $options = [
            'headers' => $headers,
            'json' => $body,
            'query' => [
                'api-version' => '3.0',
                'to' => 'en',
                'from' => $detectedLanguage,
            ],
        ];

        try {
            $response = $client->post($baseUrl, $options);
            $data = json_decode($response->getBody(), true);

            // Extract the translated text from the response
            $translatedText = $data[0]['translations'][0]['text'];
            return $translatedText;
        } catch(\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }





    public function detectLanguge($text, $apiKey) {
        $client = new Client();
        $baseUrl = 'https://api.cognitive.microsofttranslator.com/detect';

        $headers = [
            'Ocp-Apim-Subscription-Key' => $apiKey,
            'Content-Type' => 'application/json',
        ];

        $body = [
            [
                'text' => $text,
            ],
        ];

        $options = [
            'headers' => $headers,
            'json' => $body,
            'query' => [
                'api-version' => '3.0',
            ],
        ];

        try {
            $response = $client->post($baseUrl, $options);
            $data = json_decode($response->getBody(), true);

            // Extract the translated text from the response
            $detectedLanguage = $data[0]['language'];
            return $detectedLanguage;
        } catch(\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
