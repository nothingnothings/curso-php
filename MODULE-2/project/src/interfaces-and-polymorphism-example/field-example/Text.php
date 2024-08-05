<?php



namespace App;



class Text extends Field
{

    /// Overrides the 'Field' render() method
    public function render(): string  // * as enforced by the 'render()' abstract method declaration in the 'Field' class.
    {
        // HEREDOC SYNTAX
        return <<<HTML
        <input type="text" name="{$this->name}" value="" />
HTML;
    }
}