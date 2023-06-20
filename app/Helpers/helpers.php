<?php

use App\Models\Log as CustomLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

if (! function_exists('addLog')) {
    function addLog(String $action, String $description, String $platform="dashboard") {
        return CustomLog::create([
            "action" => $action,
            "description" => $description,
            "platform" => $platform,
            "user_id" => Auth::user()->id
        ]);
    }
}

// decode quill input to conteract the conversion
if (!function_exists('decodeInput')) {
    function decodeInput(String $string) {
        $decodedHtml = html_entity_decode($string);
        return $decodedHtml;
    }
}

// cleanup quill input before storing to database
if (! function_exists('cleanQuillInput')) {
    function cleanQuillInput(String $content) {
        if (strpos($content, "http://") !== false || strpos($content, "https://") !== false) {
            // The string contains "http://" or "https://"
            $pattern = '/(?:https?:\/\/\S+)/';

            if (preg_match($pattern, $content, $matches)) {
                $strippedString = strip_tags($matches[0]);
                Log::info($strippedString);

                // check if video link then embed
                if (isVideoLink($strippedString)) {
                    $strippedString = '<div class="video-container"><iframe class="lazy" data-src="'.$strippedString.'" frameborder="0" autoplay=1&amp;loop=1&amp;app_id=122963"   allow="autoplay; fullscreen; picture-in-picture" data-ready="true" loading="lazy"></iframe></div>';
                } else {
                    $strippedString = '<a href="'.$strippedString.'" target="_blank">'.$strippedString.'</a>';
                }

                $content = str_replace($matches[0], $strippedString, $content);
            }

            Log::info($content);
            // Deal with the URL accordingly
            return $content;
        } else {
            // The string does not contain "http://" or "https://"
            // echo "URL does not contain http:// or https://";
            // Deal with the URL accordingly
            return $content;
        }
    }
}

if (!function_exists('isVideoLink')) {
    function isVideoLink($link) {
        $videoLink = false;
        $videoLink = strpos($link, "youtube.com") !== false || strpos($link, "youtu.be") !== false || strpos($link, "vimeo.com") !== false;
        return $videoLink;
    }
}
