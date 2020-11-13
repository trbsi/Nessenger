<?php

namespace App\Routes;

class ApiRoute
{
    private const CURRENT_VERSION = 1;

    public static function name(string $name, ?int $version = null): string
    {
        if (null === $version) {
            $version = self::CURRENT_VERSION;
        }

        return sprintf('v%s.%s', $version, $name);
    }
}
