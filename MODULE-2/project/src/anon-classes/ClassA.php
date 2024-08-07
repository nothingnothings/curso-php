<?php



namespace App7;


class ClassA
{
    public function __construct(public int $x, public int $y)
    {

    }


    public function foo(): string
    {
        return 'foo';
    }

    public function bar(): object
    {
        return new class ($this->x, $this->y) extends ClassA {
            public function __construct(public int $x, public int $y)
            {
                parent::__construct($x, $y);
                // echo $this->y;  /// ! THIS WON'T WORK (cannot access outer class properties directly like this, they need to be passed in as arguments of the constructor)

                $this->foo();
            }
        };
    }
}

