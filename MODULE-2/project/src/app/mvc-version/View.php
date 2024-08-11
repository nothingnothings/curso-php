<?php

declare(strict_types=1);


namespace App21;

use App21\Exceptions\ViewNotFoundException;


class View
{

    public function __construct(protected string $view, public array $params = [])
    {


    }



    public function render(): bool|string
    {
        // include $this->view; // This won't work, because the view is not in the same folder as the controller, and because of the lack of output buffering.

        $viewPath = VIEW_PATH . '/' . $this->view . '.php';

        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }

        foreach ($this->params as $key => $value) {
            $$key = $value; // VARIABLE VARIABLES (never pass user input to variable variables or 'extract()')
        }

        ob_start(); // This will start the output buffering.

        include $viewPath;  // This will include the view file's content.

        return (string) ob_get_clean(); // This will return the content of the output buffer, correctly.
    }

    public static function make(string $view, array $params = []): static
    {
        return new static($view, $params);
    }


    // Used to output params in the view (for layouting):
    public function __get(string $name): mixed
    {
        return $this->params[$name] ?? null;
    }
}