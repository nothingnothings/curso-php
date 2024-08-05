<?php



namespace App;



class Checkbox extends Boolean
{


    /// Overrides the 'Field' render() method
    public function render(): string
    {
        // HEREDOC SYNTAX
        return <<<HTML
            <input type="checkbox" name="{$this->name}" value="" />
    HTML;
    }
}