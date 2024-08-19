<?php declare(strict_types=1);

namespace App\Attributes;

use App\Interfaces\RouteInterface;

// This is an example of how to create an attribute (and use it, in the HomeController.php file)
#[\Attribute(\Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]  // with 'Attribute::TARGET_METHOD', we state that this attribute can only be used on methods.
class Route implements RouteInterface
{
    public function __construct(public string $routePath, public string $method = 'get') {}
}
