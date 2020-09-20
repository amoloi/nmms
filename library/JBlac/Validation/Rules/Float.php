<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Float extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return is_float(filter_var($input, FILTER_VALIDATE_FLOAT));
    }
}

