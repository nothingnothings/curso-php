<?php



namespace App;



class Radio extends Boolean
{



    /// Overrides the 'Field' render() method
    public function render(): string
    {
        // HEREDOC SYNTAX
        return <<<HTML
            <input type="radio" name="{$this->name}" value="" />
    HTML;
    }
}