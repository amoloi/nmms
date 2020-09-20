<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Prnt extends JBlac_Validation_Rules_AbstractCtypeRule
{
    protected function ctypeFunction($input)
    {
        return ctype_print($input);
    }
}

