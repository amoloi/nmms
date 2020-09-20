<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Json extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return (bool) (json_decode($input));
    }
}

