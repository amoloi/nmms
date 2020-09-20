<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_NullValue extends JBlac_Validation_Rules_NotEmpty
{
    public function validate($input)
    {
        return is_null($input);
    }
}

