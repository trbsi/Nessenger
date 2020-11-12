<?php

namespace App\Code\V1\Messages\Services;

use Illuminate\Support\Facades\Log;
use VStelmakh\UrlHighlight\Highlighter\HtmlHighlighter;
use VStelmakh\UrlHighlight\UrlHighlight;

class MessageUrlDetector
{
    //private const URL_REGEX = '/(https?:\/\/)?[\w\-~]+(\.[\w\-~]+)+(\/[\w\-~@:%]*)*(#[\w\-]*)?(\?[^\s]*)?/i';

    public function replaceUrlWithClickableLinks(string $message): string
    {
        $highlighter = new HtmlHighlighter(
            'http', // string - scheme to use for urls matched by top level domain
            ['class' => 'underline', 'target' => '_blank', 'rel' => 'nofollow'],     // string[] - key/value map of tag attributes, e.g. ['rel' => 'nofollow', 'class' => 'light']
            '',     // string - content to add before highlight: {here}<a...
            ''      // string - content to add after highlight: ...</a>{here}
        );
        $urlHighlight = new UrlHighlight(null, $highlighter);
        return $urlHighlight->highlightUrls($message);

    }
/*
    //ovo je moj pokušaj nešto napraviti
    private function myTry()
    {

        preg_match_all(self::URL_REGEX, $message, $matches);
        if (!isset($matches[0])) {
            return $message;
        }

        $matches = array_unique($matches[0]);
        Log::info($matches);
        foreach ($matches as $match) {
            Log::info($match);
            $replaceUrl = sprintf('<a href="%1$s" target="_blank">%1$s</a>', $match);
            $message = preg_replace(sprintf('#\b%s\b(?!\S)#', $match), $replaceUrl, $message);

        }
        Log::info($message);
        return $message;
    }
*/
}
