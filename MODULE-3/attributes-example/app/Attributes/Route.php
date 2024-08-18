<?php declare(strict_types=1);

namespace App\Attributes;

// This is an example of how to create an attribute (and use it, in the HomeController.php file)

#[\Attribute]
class Route
{
    public function __construct(public string $routePath, string $method = 'get') {}
}
 