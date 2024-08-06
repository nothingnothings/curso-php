<?php

namespace App5;

class ClassA
{
    // protected string $name = 'A';

    protected static string $name = "A"; // is static


    public static function getName(): string // is also static.
    {
        // var_dump(get_class($this));
        // return $this->name;
        var_dump(self::class); //  - Will always print "App5\ClassA", even when called from a subclass, like ClassB...
        // return self::$name; // ! THIS IS WITHOUT LATE STATIC BINDING (will always refer/return the value of the classA)...
        return static::$name; // * THIS IS WITH LATE STATIC BINDING (will always refer/return the value of the class that called it, classA or classB)...

    }



    public static function make(): static
    {
        // return new ClassA();
        // return new self(); // ! This won't work (no late static binding)
        return new static(); // * This will work (with late static binding)
    }
}