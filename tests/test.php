<?php

declare(strict_types=1);

use Chaungoclong\PathToRegex\RouteRegexFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$routeRegex = RouteRegexFactory::create(
    '/posts/{postId}/comments/{commentId?}'
);

// case full route parameters
$matchesFullParameter = $routeRegex->match('/posts/1/comments/10');
var_dump($matchesFullParameter);

// case has only required parameters with splash at the end
$matchesOnlyRequiredParameterWithSplashAtEnd = $routeRegex->match(
    '/posts/1/comments/'
);

var_dump($matchesOnlyRequiredParameterWithSplashAtEnd);

// case has only required parameters
$matchesOnlyRequiredParameter = $routeRegex->match('/posts/1/comments');

var_dump($matchesOnlyRequiredParameter);