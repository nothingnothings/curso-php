<?php declare(strict_types=1);

namespace PHP_8_1_Examples\FinalConstant;

class TableQuery
{
    // public const DEFAULT_LIMIT = 25; // * No 'final' keyword - this means that the constant can be changed by the child class, during runtime.
    final public const DEFAULT_LIMIT = 25;  // * 'final' keyword present - this means that the constant CANNOT be changed by the child class, during runtime. If you try to do so, an exception gets thrown.
}
