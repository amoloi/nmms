<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Regex extends JBlac_Validation_Rules_AbstractRule
{
    public $regex;

    public function __construct($regex)
    {
        $this->regex = $regex;
    }

    public function validate($input)
    {
        return (bool) preg_match($this->regex, $input);
    }
}

