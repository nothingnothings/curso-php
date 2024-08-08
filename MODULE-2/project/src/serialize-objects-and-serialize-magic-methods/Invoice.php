<?php

namespace App13;

class Invoice
{
    public function __construct(
        public string $id,
        public float $amount,
        public string $description,
        public string $creditCardNumber
    ) {
    }


    // This is the 'sleep()' magic method. It is related to serialization. It works/is called as a 'pre-serialization' hook... 
    public function __sleep(): array
    {
        return ["id", "amount"]; // You choose which properties to serialize/return in the serialized format. The rest of the propertise won't be serialized/shown in the final result.
        // description and creditCardNumber won't be serialized because they are not listed in the __sleep() method.


    }

    // This is the 'wakeup()' magic method. It is related to serialization. It works/is called as a 'post-unserialization' hook (called after the 'unserialize()' method is called using this object as argument)
    public function __wakeup(): void
    {

    }



    // * 'SERIALIZE()' and 'UNSERIALIZE()'  are better/more used than 'SLEEP()' and 'WAKEUP()', because they are more flexible and can be used for more things.

    // This is the 'serialize()' magic method. It is related to serialization.
    public function __serialize(): array
    {
        return [
            "id" => $this->id,
            "amount" => $this->amount,
            "description" => $this->description,
            "creditCardNumber" => base64_encode($this->creditCardNumber),
            'foo' => 'bar'
        ];
    }


    // This is the 'unserialize()' magic method. It is related to serialization.
    public function __unserialize(array $data): void
    {
        // * Basically restores the object's state from the data that was serialized.
        var_dump($data);
        $this->id = $data['id'];
        $this->amount = $data['amount'];
        $this->description = $data['description'];
        $this->creditCardNumber = base64_decode($data['creditCardNumber']);
    }

}