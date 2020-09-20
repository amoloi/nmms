<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Lowercase extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return $input === mb_strtolower($input, mb_detect_encoding($input));
    }
}

