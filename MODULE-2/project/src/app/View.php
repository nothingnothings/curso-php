<?php

declare(strict_types=1);


namespace App19\Classes;


class View
{

    public function __construct(protected string $view, public array $params = [])
    {


    }



    public function render()
    {
        // include $this->view;
        include VIEW_PATH . $this->view . '.php';
    }


}