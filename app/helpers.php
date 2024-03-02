<?php

function nl2p(?string $string)
{
    $paragraphs = '';

    if (!$string) {
        return $paragraphs;
    }

    foreach (explode("\n", $string) as $line) {
        if (trim($line)) {
            $paragraphs .= '<p>' . $line . '</p>';
        }
    }

    return $paragraphs;
}

function routeWith(array $parameters = [], bool $absolute = true): string
{
    return route(
        request()->route()->getName(),
        array_merge(
            request()->query(),
            request()->route()->parameters(),
            $parameters,
        ),
        $absolute,
    );
}

function routeWithout(string|array $parameters = [], bool $absolute = true): string
{
    if (is_string($parameters)) {
        $parameters = [$parameters];
    }

    return route(
        request()->route()->getName(),
        array_diff_key(
            array_merge(
                request()->query(),
                request()->route()->parameters(),
            ),
            array_flip($parameters),
        ),
        $absolute,
    );
}
