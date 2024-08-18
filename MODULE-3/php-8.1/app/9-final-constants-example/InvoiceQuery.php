<?php declare(strict_types=1);

namespace PHP_8_1_Examples\FinalConstant;

class InvoiceQuery extends TableQuery
{
    public const DEFAULT_LIMIT = 50;  // if final is set, in the parent class, this constant CANNOT be changed by the child class, during runtime.
}
