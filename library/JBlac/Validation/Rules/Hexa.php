<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Hexa extends JBlac_Validation_Rules_AbstractRule
{
    public function __construct()
    {
        parent::__construct();
        trigger_error("Use xdigits instead.",
            E_USER_DEPRECATED);
    }

    public function validate($input)
    {
        return ctype_xdigit($input);
    }
}

