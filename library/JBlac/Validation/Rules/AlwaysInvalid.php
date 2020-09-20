<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_AlwaysInvalid extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return false;
    }
}

