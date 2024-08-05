<?php




namespace App2;


// ! WITHOUT INHERITANCE:
// class ToasterPro
// {


//     public array $slices = [];
//     public int $size = 4; // Has more slices than the base class (Toaster)

//     public function addSlice(string $slice): void
//     {
//         if (count($this->slices) < $this->size) { // only adds toasts if the array is not filled with >= 2 slices
//             $this->slices[] = $slice;
//         }
//     }

//     public function toast()
//     {
//         foreach ($this->slices as $i => $slice) {
//             echo ($i + 1) . ': Toasting ' . $slice . PHP_EOL;
//         }
//     }


//     public function toastBagel()
//     {
//         foreach ($this->slices as $i => $slice) {
//             echo ($i + 1) . ': Toasting ' . $slice . ' with bagel option' . PHP_EOL;
//         }
//     }
// }


// * WITH INHERITANCE:
class ToasterPro extends Toaster
{

    public int $size = 4; // Has more slices than the base class (Toaster), so we override the base class's property value (which was 2)


    public function toastBagel()
    {
        foreach ($this->slices as $i => $slice) {
            echo ($i + 1) . ': Toasting ' . $slice . ' with bagel option' . PHP_EOL;
        }
    }
}