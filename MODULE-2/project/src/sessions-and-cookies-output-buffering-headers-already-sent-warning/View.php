<?php 

declare(strict_types= 1);


namespace App19\Classes;


class View {
    
    public function __construct($view, $data) {
        
        $this->view = $view;
        $this->data = $data;
    }
    
    static public function make($view, $data) {
        return new static($view, $data);
    }

    public function render() {
        return '';
    }
}