<?php declare(strict_types=1);

// class Customer
// {
//      ! OLD WAY OF INITIALIZING A PROPERTY WITH A DEFAULT VALUE OF AN OBJECT (using 'new', in a roundabout way)
//     public function __construct(public ?Address $address = null)
//     {
//         $this->address ??= new Address();
//     }
// }

// * Since PHP 8.1, we can use the 'new' keyword in the initializer of a property, to create an object, and assign it to the property, as a default value:
class Customer
{
    public function __construct(public Address $address = new Address()) {}  // * This is the usage of 'new' in the initializer of a property.
}
