<?php



namespace App;


// * ABSTRACT CLASS EXAMPLE
abstract class Field
{
    public function __construct(protected string $name)
    {

    }

    // * Regular method:
    // public function render(): string
    // {
    //     return '';
    // }


    // * Abstract method (only the declaration/definition, without the implementation):
    abstract public function render(): string;

}