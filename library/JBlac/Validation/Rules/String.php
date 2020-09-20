<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_String extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return is_string($input);
    }
}

