<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Odd extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return ((int) $input % 2 !== 0);
    }
}

