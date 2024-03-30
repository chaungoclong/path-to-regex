<?php

declare(strict_types=1);

namespace Chaungoclong\PathToRegex;

class RouteRegexFactory
{
    private static string $placeholderPattern = '/{\s*([a-zA-Z_]\w*\??)\s*(?::\s*([^{}]*(?:{(?-1)}[^{}]*)*))?}/';
    private static string $defaultParameterPattern = '[^\/#\?]+?';

    public static function create(string $routePattern): RouteRegex
    {
        return new RouteRegex(self::convertRoutePatternToRegex($routePattern));
    }

    private static function convertRoutePatternToRegex(string $routePattern): string
    {
        $regex = preg_replace_callback(
            self::$placeholderPattern,
            static function ($matches) {
                [$parameterName, $parameterPattern] = [
                    $matches[1],
                    $matches[2] ?? self::$defaultParameterPattern
                ];

                $isOptionalParameter = str_ends_with($parameterName, '?');

                if ($isOptionalParameter) {
                    $optionalParameterName = rtrim($parameterName, '?');

                    return "(?:\/(?P<$optionalParameterName>$parameterPattern))?";
                }

                return "(?:\/(?P<$parameterName>$parameterPattern))";
            },
            str_replace("/", "\\/", $routePattern)
        );

        return '~^' . str_replace('\/(?:\/', '[\/]?(?:\/', $regex) . '$~i';
    }
}