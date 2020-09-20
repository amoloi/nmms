<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_NotEmpty extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        if (is_string($input)) {
            $input = trim($input);
        }

        return !empty($input);
    }
}

