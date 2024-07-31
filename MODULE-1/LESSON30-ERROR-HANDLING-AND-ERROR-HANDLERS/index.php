<?php


// Error Handling 

// Set/alter error reporting settings, during runtime, if you wish:
error_reporting(E_ALL); // Catch all errors

error_reporting(E_ALL & ~E_WARNING); // Catch all errors, except warnings

echo $x; // This is an undefined variable, but it won't be reported, because of the '~E_WARNING' value.


// Trigger an error manually:
trigger_error("YOUR ERROR MESSAGE HERE", E_USER_ERROR); // first argument is the error message, the second argument is the error <type>

// 'E_USER_ERROR' is a type of error that is fatal, and will stop the script from executing further.


echo 1; // this line will not be reached, because the error above will stop the script from executing further.



trigger_error("YOUR OTHER ERROR MESSAGE", E_USER_WARNING); // 'E_USER_WARNING' won't stop the script from executing further, but will trigger a warning.







// Custom Error Handlers:
// Error Handling (this is the default error handler, normal php error handler, because we return 'false' and decide to use the default php error handler)
function errorHandler1(int $type, string $msg, ?string $file = null, ?int $line = null)
{

    echo $type . ':' . $msg . ' in ' . $file . ' on line ' . $line;


    return false; // usado para voltar ao error handling comum do PHP... 
}





// Error Handling (with this error handler, returning anything other than 'false', we continue the script execution, without the default php error handler)
function errorHandler2(int $type, string $msg, ?string $file = null, ?int $line = null)
{


    echo $type . ':' . $msg . ' in ' . $file . ' on line ' . $line;


    return; // usado para voltar ao error handling comum do PHP... 
}


// Error Handling (with this error handler, with 'exit', we STOP the script execution, without the default php error handler)
function errorHandler3(int $type, string $msg, ?string $file = null, ?int $line = null)
{


    echo $type . ':' . $msg . ' in ' . $file . ' on line ' . $line;


    exit; // usado para voltar ao error handling comum do PHP... 
}






// Set alternative error handler as default error handler (and the error type will overwrite the value set beforehand with 'error_reporting()'...):
set_error_handler('errorHandler3', E_ALL); // 'E_ALL' is the error type, we want to catch all errors, all of them will trigger the first function, passed as a parameter.






// Reset the default error handler:
restore_error_handler(); // This will reset the default error handler, to the default php error handler.