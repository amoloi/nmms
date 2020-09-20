<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Email extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return is_string($input) && filter_var($input, FILTER_VALIDATE_EMAIL);
    }
}