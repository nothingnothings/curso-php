<?php





namespace app3;


class Invoice
{

    // THIS IS THE MAGIC GET METHOD, the first of the magic methods. It is called when you try to access a property that doesn't exist.
    public function __get(string $name)
    {
        var_dump($name);
    }

    // THIS IS THE MAGIC SET METHOD, the second of the magic methods. It is called when you try to set a property that doesn't exist.
    public function __set(string $name, $value)
    {
        var_dump($name);
    }
}