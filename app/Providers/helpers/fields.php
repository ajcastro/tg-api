<?php

if (!function_exists('fields')) {
    function fields($relation, array $fields)
    {
        return collect($fields)->map(function ($field) use ($relation) {
            return "{$relation}.{$field}";
        })->all();
    }
}
