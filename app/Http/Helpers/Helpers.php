<?php


if (!function_exists('randomize_name')) {
    function randomize_name($array_param, $char_length)
    {
        $randomize = is_string($array_param) ? $array_param : pick_abbrev($array_param);
        $randomized_name = fake()->regexify("[A-Za-z]{" . $char_length . "}'s " . $randomize);

        return $randomized_name;
    }
}

if (!function_exists('pick_abbrev')) {
    function pick_abbrev($array_param)
    {
        return fake()->randomElement($array_param);
    }
}
