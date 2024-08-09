<?php




namespace App17;




// If we want to iterate over some of the properties of this object, we need to implement the Iterator/IteratorAggregate interfaces
//  TODO - This (Iterator version) is the 'overkill' version, that is to be used only when you need a very specific implementation/logic of looping over an object's properties.
// class InvoiceCollection implements \Iterator
// {
//     public function __construct(public array $invoices)
//     {

//     }


//     public function current(): mixed {
        
//         echo __METHOD__ . PHP_EOL; // this will print the current method's name
//         return current($this->invoices); // RETURN THE _ CURRENT ELEMENT/INVOICE, FROM THE '$invoices' list/array....
//     } 

//     public function next(): void {
//         echo __METHOD__ . PHP_EOL;
//         next($this->invoices); // BRINGS THE INTERNAL POINTER TO THE __ NEXT ELEMENT
//     }
    
//     public function key(): mixed {
//         echo __METHOD__ . PHP_EOL;
//         return key($this->invoices); // RETURNS THE KEY OF THE CURRENT ELEMENT OF AN ARRAY
//     }
    
//     public function valid(): bool {
//         echo __METHOD__ . PHP_EOL;
//         return current($this->invoices) !== false; // CHECKS IF THE CURRENT POSITION IS VALID. IF THIS METHOD RETURNS FALSE, THE FOREACH LOOP WILL END
        
//     }
    
//     public function rewind(): void {
//         echo __METHOD__ . PHP_EOL;
//         reset($this->invoices); // THIS GETS CALLED AT THE BEGINNING OF THE FOREACH LOOP. IT RESETS THE  __ 'ARRAY POINTER' BACK TO THE BEGINNING OF IT
//     }       
// }







// TODO - Simpler version of the above, using the 'IteratorAggregate' interface and the 'ArrayIterator' class:
// class InvoiceCollection implements \IteratorAggregate
// {
//     public function __construct(public array $invoices)
//     {

//     }

//     public function getIterator(): \Traversable {
//         return new \ArrayIterator($this->invoices);
//     }


// }




// TODO - SAME AS ABOVE, BUT WITH 'extends' and inheritance, to avoid duplication of code (the 'getIterator' method):
class InvoiceCollection extends Collection
{
    // ! This, the constructor, is implicitly inherited from the 'Collection' class, so we don't need to define it again.
    // public function __construct(public array $invoices)
    // {
    //     parent::__construct($invoices);
    // }



    // * Outsourced to the 'Collection' class, to avoid duplication of code:
    // public function getIterator(): \Traversable {
    //     return new \ArrayIterator($this->invoices);
    // }
}