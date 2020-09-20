<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_MacAddress extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return !empty($input) && preg_match('/^(([0-9a-fA-F]{2}-){5}|([0-9a-fA-F]{2}:){5})[0-9a-fA-F]{2}$/', $input);
    }
}

