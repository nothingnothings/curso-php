<?php




namespace App17;




// If we want to iterate over some of the properties of this object, we need to implement the Iterator/IteratorAggregate interfaces
class InvoiceCollection implements \Iterator
{
    public function __construct(public array $invoices)
    {

    }


    public function current(): mixed {
        
        echo __METHOD__ . PHP_EOL; // this will print the current method's name
        return current($this->invoices); // RETURN THE _ CURRENT ELEMENT/INVOICE, FROM THE '$invoices' list/array....
    } 

    public function next(): void {
        echo __METHOD__ . PHP_EOL;

        return next($this->invoices); // BRINGS THE INTERNAL POINTER TO THE __ NEXT ELEMENT
    }
    
    public function key() {
        
    }
    
    public function valid() {
        
    }
    
    public function rewind() {
        
    }       
}