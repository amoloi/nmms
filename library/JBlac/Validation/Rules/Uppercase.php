<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Uppercase extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return $input === mb_strtoupper($input, mb_detect_encoding($input));
    }
}

