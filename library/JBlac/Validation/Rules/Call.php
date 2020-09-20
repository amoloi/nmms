<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Call extends JBlac_Validation_Rules_AbstractRelated
{
    public function getReferenceValue($input)
    {
        return call_user_func_array($this->reference, array(&$input));
    }

    public function hasReference($input)
    {
        return is_callable($this->reference);
    }
}

