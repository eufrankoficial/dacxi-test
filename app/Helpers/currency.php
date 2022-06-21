<?php


if (!function_exists('arrayToSeparatedComma')) {
    function arrayToSeparatedComma($array)
    {
        return implode(',', $array);
    }
}
