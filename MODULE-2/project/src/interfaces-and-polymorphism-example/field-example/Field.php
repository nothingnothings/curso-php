<?php



namespace App;


// * ABSTRACT CLASS EXAMPLE
abstract class Field implements Renderable
{
    public function __construct(protected string $name)
    {

    }

}