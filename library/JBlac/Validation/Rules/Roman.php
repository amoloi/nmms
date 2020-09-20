<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Roman extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        return (boolean) preg_match('/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/', $input);
    }
}

