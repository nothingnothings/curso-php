<?php declare(strict_types=1);

namespace PHP_8_1_Examples\ReadOnlyProperty;

// * Without readonly properties:
// class Address
// {
//     public function __construct(private string $street,
//         private string $city,
//         private string $state,
//         private string $postalCode,
//         private string $country) {}

//      * Without readonly properties:
//     public function getStreet(): string
//     {
//         return $this->street;
//     }

//     public function getCity(): string
//     {
//         return $this->city;
//     }

//     public function getState(): string
//     {
//         return $this->state;
//     }

//     public function getPostalCode(): string
//     {
//         return $this->postalCode;
//     }

//     public function getCountry(): string
//     {
//         return $this->country;
//     }
// }

// * With readonly properties:
class Address
{
    public function __construct(
        public readonly string $street, // With 'readonly', developers cannot change the value of the property from outside.
        public readonly string $city,
        public readonly string $state,
        public readonly string $postalCode,
        public readonly string $country
    ) {}

    // * with readonly properties (no getter methods needed):
} 
