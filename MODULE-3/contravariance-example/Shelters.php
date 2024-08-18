<?php declare(strict_types=1);

class CatShelter implements AnimalShelter
{
    public function adopt(string $name): Cat  // instead of returning class type Animal, it can return class type Cat
    {
        return new Cat($name);
    }
}

class DogShelter implements AnimalShelter
{
    public function adopt(string $name): Dog  // instead of returning class type Animal, it can return class type Dog
    {
        return new Dog($name);
    }
}
