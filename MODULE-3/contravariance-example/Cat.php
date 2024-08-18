<?php declare(strict_types=1);

class Cat extends Animal
{
    public function speak()
    {
        echo $this->name . ' meows';
    }

    public function eat(Food $food)
    {
        echo $this->name . ' eats ' . get_class($food);
    }
}
