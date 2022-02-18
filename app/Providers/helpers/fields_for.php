<?php

if (!function_exists('fields_for')) {
    function fields_for($relation, array $fields)
    {
        return collect($fields)->map(function ($field) use ($relation) {
            return "{$relation}.{$field}";
        })->all();
    }
}
