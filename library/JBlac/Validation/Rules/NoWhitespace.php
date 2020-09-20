<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_NoWhitespace extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return is_null($input) || !preg_match('#\s#', $input);
    }
}

