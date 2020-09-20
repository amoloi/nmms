<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Phone extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return !empty($input) && preg_match('/^[+]?([\d]{0,3})?[\(\.\-\s]?([\d]{1,3})[\)\.\-\s]*(([\d]{3})[\.\-\s]?([\d]{4})|([\d]{2}[\.\-\s]?){4})$/', $input);
    }
}