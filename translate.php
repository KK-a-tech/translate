<?php
require_once ('config.php');

const SUPPORTED_LANGUAGES = [
    'en' => 'English',
    'fr' => 'French',
    'ja' => 'Japanese'
];

function translate($text, $source_lang, $target_lang) {
    $url = 'https://api-free.deepl.com/v2/translate';
    $auth_key = DEEPL_AUTH_KEY;
    
    $post_data = http_build_query([
        'auth_key' => $auth_key,
        'text' => $text,
        'source_lang' => $source_lang,
        'target_lang' => $target_lang
    ]);
    
    $options = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'content' => $post_data
        ]
    ];
    
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    if ($result === false) {
        return ['success' => false, 'message' => 'Translation failed'];
    }
    
    $json = json_decode($result, true);
    return [
        'success' => true,
        'translation' => $json['translations'][0]['text'] ?? ''
    ];
}
