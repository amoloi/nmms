<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Xdigit extends JBlac_Validation_Rules_AbstractCtypeRule
{
    public function ctypeFunction($input)
    {
        return ctype_xdigit($input);
    }
}

