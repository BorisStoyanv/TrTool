<?php

if (! function_exists('decodeUnicode')) {
    /**
     * Decodes unicode string.
     *
     * @param  string  $str
     * @return string
     */
    function decodeUnicode($str)
    {
        return html_entity_decode('&#x' . ltrim($str, 'U+') . ';', ENT_NOQUOTES, 'UTF-8');
    }
    
}
