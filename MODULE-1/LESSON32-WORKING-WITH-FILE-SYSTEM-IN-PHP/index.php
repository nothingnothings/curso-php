<?php


// Working with File System:

// 1) scandir() is used to get the list of files and directories in a directory:

$dir = scandir(__DIR__); // __DIR__ is a magic constant that returns the current directory


var_dump($dir);



// 2) is_dir() is used to check if a directory exists:

$dir = __DIR__ . '/images';
var_dump(is_dir($dir));




// 3) is_file() is used to check if a file exists:

$file = __DIR__ . '/images/logo.png';
var_dump(is_file($file));



// 4) mkdir() is used to create a directory. You can use 'recursive: true' to create a directory recursively:
mkdir(__DIR__ . '/images');
var_dump(is_dir(__DIR__ . '/images'));


mkdir('foo/bar', recursive: true); // Create foo folder, and then bar folder inside foo



// 5) rmdir() is used to remove a directory:
rmdir(__DIR__ . '/images');
var_dump(is_dir(__DIR__ . '/images'));


// 6) file_exists() is used to check if a file exists:

if (file_exists('foo.txt')) {
    echo 'File exists';
} else {
    echo 'File not found';
}


echo PHP_EOL;

clearstatcache(); // Used to clear the stat cache (makes sure that the 'filesize()' function returns the correct value, and not the previous, cached value)

//  7) filesize() is used to get the size of a file:
$file = __DIR__ . '/foo.txt';
echo filesize($file); // filesize is a function that typically caches its return value, for better performance reasons.





// 8) file_put_contents() is used to write a string to a file:
// file_put_contents(__DIR__ . '/foo.txt', 'Hello World 2!');
// file_put_contents('bar.txt', 'hello', FILE_APPEND); // Use this flag if you want to append instead of overwriting the existing file...



// 9) file_get_contents() is used to read the contents of a file, which you can store in a variable:
// ? offset and length are optional parameters:
echo file_get_contents(__DIR__ . '/foo.txt', offset: 3, length: 2); // file_get_contents() is a function that reads the entire file into a string.









echo PHP_EOL;




// 10) fopen() is used to open a file. If the file is not found, fopen() will return false and a warning:
$fileContents = fopen('foo.txt', 'r'); // WE DEFINE THAT WE WANT TO OPEN THE FILE FOR READING.

echo $fileContents;


// $fileContentsNoWarning = @fopen('foo.txt', 'r'); // ! BAD PRACTICE - We use @ to suppress the warning, if the file is not found.


// * Instead of using @ to suppress, the warning, it's better to use the file_exists() function:
// if (file_exists('foo.txt')) {
//     $files = fopen('foo.txt', 'r');
//     echo $file;
// } else {
//     echo 'File not found';
// }


// 11) fgts is used to read a file line by line:


$file = fopen('foo.txt', 'r');
$file2 = fopen('foo2.txt', 'r');

while (($line = fgets($file)) !== false) {
    echo $line . '<br />';
}



// 12) fclose() is used to close a file:
fclose($file);



// 13) fwrite() is used to write a string to a file:
fwrite($file2, 'Hello World 3!');
fclose($file2);
var_dump(filesize(__DIR__ . '/foo2.txt'));


// 14) fgetcsv() is used to read a CSV file. It parses a CSV file line by line, returning an array of values for each line.
$file = fopen(__DIR__ . '/foo.csv', 'r');
while (($line = fgetcsv($file)) !== false) {
    print_r($line);
}

fclose($file);


// 15) unlink() is used to delete a file:
unlink(__DIR__ . '/foo.txt');
unlink(__DIR__ . '/foo2.txt');


// 16) copy() is used to copy a file:
copy(__DIR__ . '/foo.txt', __DIR__ . '/foo2.txt'); // Copy the file foo.txt to foo2.txt
var_dump(filesize(__DIR__ . '/foo2.txt'));


// 17) rename() is used to MOVE a file (besides renaming):
rename(__DIR__ . '/foo2.txt', __DIR__ . '/foo3.txt'); // Rename foo2.txt to foo3.txt

// using rename() to move a file between directories:
rename(__DIR__ . '/foo.txt', __DIR__ . '/images/foo.txt'); // Rename (move) foo.txt to images/foo.txt


// 18) pathinfo() is used to get more information about a file or directory path:
$path = __DIR__ . '/images/foo.txt';
var_dump(pathinfo($path));
var_dump(pathinfo($path, PATHINFO_EXTENSION)); // Get the extension of the file
var_dump(pathinfo($path, PATHINFO_FILENAME)); // Get the filename of the file
var_dump(pathinfo($path, PATHINFO_DIRNAME)); // Get the directory of the file
var_dump(pathinfo($path, PATHINFO_BASENAME)); // Get the basename of the file   