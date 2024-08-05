<?php




namespace App2;



class Toaster
{


    // public array $slices = [];
    // public int $size = 2; // Indicates the max amount of slices the toaster can toast at the same time.
    // private int $size = 2; // * PRIVATE PROPERTIES CANNOT BE ACCESSED AND OVERWRITTEN FROM INSIDE OF CHILD CLASSES (like ToasterPro, for example).


    protected array $slices = [];
    protected int $size = 2; // * PROTECTED PROPERTIES CAN BE ACCESSED AND OVERWRITTEN FROM INSIDE OF CHILD CLASSES (like ToasterPro, for example), but still cannot be accessed FROM OUTSIDE OF THE CLASSES (which is good, for security reasons and for keeping encapsulation and abstraction).


    public function addSlice(string $slice): void
    {
        var_dump($this); // * this will change depending on the caller of this method (the child class or the parent class)

        if (count($this->slices) < $this->size) { // only adds toasts if the array is not filled with >= 2 slices
            $this->slices[] = $slice;
        }
    }

    public function toast()
    {
        foreach ($this->slices as $i => $slice) {
            echo ($i + 1) . ': Toasting ' . $slice . PHP_EOL;
        }
    }
}