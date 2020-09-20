<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Space extends JBlac_Validation_Rules_AbstractCtypeRule
{
    protected function ctypeFunction($input)
    {
        return ctype_space($input);
    }
}

