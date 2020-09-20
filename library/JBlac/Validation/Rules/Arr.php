<?php
//namespace Respect\Validation\Rules;
//
//use ArrayAccess;
//use Countable;
//use Traversable;

class JBlac_Validation_Rules_Arr extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return is_array($input) || ($input instanceof ArrayAccess
            && $input instanceof Traversable
            && $input instanceof Countable);
    }
}

