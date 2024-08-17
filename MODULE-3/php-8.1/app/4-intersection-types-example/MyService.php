<?php declare(strict_types=1);

namespace PHP_8_1_Examples\IntersectionTypes;

// Example of no intersection types:
// class MyService
// {
//     public function __construct(
//         private Syncable|Payable $entity
//     ) {}

//     public function handle()
//     {
//         // * any of the two classes will have problems, because one has sync, the other has pay, but no one has both.
//         $this->entity->pay();
//         $this->entity->sync();
//     }
// }

// * Example of intersection types:
class MyService
{
    public function __construct(
        private Syncable&Payable $entity
    ) {}

    public function handle()
    {
        // * any of the two classes will have problems, because one has sync, the other has pay, but no one has both.
        $this->entity->pay();
        $this->entity->sync();
    }
}   