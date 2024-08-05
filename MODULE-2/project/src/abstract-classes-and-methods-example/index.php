<?php


require '../../vendor/autoload.php'; // imports the composer's autoloader




$fields = [
    // new \App\Field('baseField'),  // * WILL error out, because we defined 'Field' as an abstract class (abstract classes cannot be instantiated)
    new \App\Text('textField'),
    // new \App\Boolean('booleanField'), // * WILL error out, because we defined 'Boolean' as an abstract class (abstract classes cannot be instantiated)
    new \App\Checkbox('checkboxField'),
    new \App\Radio('radioField')
];

// Call render() method on each field:
foreach ($fields as $field) {
    echo $field->render() . '<br />';
}