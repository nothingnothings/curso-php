<?php





namespace app3;


class Invoice
{

    protected array $data = [];


    private float $amount;
    private int $id;
    private string $accountNumber;


    protected function process()
    {
        var_dump('process');
    }

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

    // THIS IS THE MAGIC ISSET METHOD, the third of the magic methods. It is called when you try to check if a property exists.
    public function __isset(string $name): bool
    {
        return array_key_exists($name, $this->data);
    }

    // THIS IS THE MAGIC UNSET METHOD, the fourth of the magic methods. It is called when you try to unset a property that doesn't exist.
    public function __unset(string $name)
    {
        unset($this->data[$name]);
    }

    // THIS IS THE MAGIC CALL METHOD, the fifth of the magic methods. It is called when you try to call a method that doesn't exist.
    public function __call(string $name, array $arguments)
    {
        // var_dump($name);
        if (method_exists($this, $name)) {
            // $this->$name(...$arguments);
            call_user_func_array([$this, $name], $arguments); // best way to do this (call the method with the original arguments)
        }
    }

    // THIS IS THE MAGIC CALLSTATIC METHOD, the sixth of the magic methods. It is called when you try to call a static method that doesn't exist.
    public static function __callStatic(string $name, array $arguments)
    {
        var_dump('static', $name, $arguments);
    }

    // THIS IS THE MAGIC TOSTRING METHOD, the seventh of the magic methods. It is called when you try to echo or convert the object to a string.
    public function __toString()
    {
        return 'toString Triggered';
    }

    // THIS IS THE MAGIC INVOKE METHOD, the eighth of the magic methods. It is called when you try to call the object as a function.
    public function __invoke()
    {
        var_dump('invoke');
    }

    // THIS IS THE MAGIC DEBUGINFO METHOD, the ninth of the magic methods. It is called when you try to get debug information about the object.
    public function __debugInfo()
    {
        // This is used to protect the object from being var_dumped or serialized (return only a part of the informations, for example):
        return [
            'id' => $this->id,
            'accountNumber' => '****' . substr($this->accountNumber, -4)
        ];

        // return ['data' => $this->data];
    }
}