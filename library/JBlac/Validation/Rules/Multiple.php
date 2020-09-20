<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Multiple extends JBlac_Validation_Rules_AbstractRule
{
    public $multipleOf;

    public function __construct($multipleOf)
    {
        $this->multipleOf = $multipleOf;
    }

    public function validate($input)
    {
        if ($this->multipleOf == 0) {
            return ($input == 0);
        }

        return ($input % $this->multipleOf == 0);
    }
}

