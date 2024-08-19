<?php declare(strict_types=1);

namespace App\Attributes;

#[\Attribute(\Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]  // with 'Attribute::TARGET_METHOD', we state that this attribute can only be used on methods.
class Put extends Route
{
    public function __construct(public string $path)
    {
        parent::__construct($path, 'put');
    }
}
