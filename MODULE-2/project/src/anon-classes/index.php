<?php



require_once '../../src/vendor/autoload.php'; // imports the composer's autoloader





// Anonymous Class example (can also receive arguments in the constructor, extend classes, implement interfaces and use traits, exactly like a regular class)
$obj = new class (1, 2, 3) extends MyClass implements MyInterface {

    use MyTrait;

    public function __construct(public int $x, public int $y, public int $z)
    {

    }
};





var_dump(get_class($obj)); // Will print the name that was automatically generated by the engine.