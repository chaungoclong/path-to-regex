<?php

declare(strict_types=1);

namespace Chaungoclong\PathToRegex;

class RouteRegex
{
    private string $regex;

    public function __construct(string $regex)
    {
        $this->regex = $regex;
    }

    public function match(string $routePattern): array
    {
        preg_match($this->regex, $routePattern, $matches);

        return $matches;
    }

    public function getRegex(): string
    {
        return $this->regex;
    }
}