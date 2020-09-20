<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Object extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return is_object($input);
    }
}

