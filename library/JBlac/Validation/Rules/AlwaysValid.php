<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_AlwaysValid extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return true;
    }
}

