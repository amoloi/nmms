<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Bool extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return is_bool($input);
    }
}

