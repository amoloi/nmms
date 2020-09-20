<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_PerfectSquare extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return is_numeric($input) && sqrt($input) * sqrt($input) == $input;
    }
}

