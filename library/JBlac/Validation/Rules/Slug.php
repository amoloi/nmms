<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Slug extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        if (strstr($input, '--')) {
            return false;
        }

        if (!preg_match('@^[0-9a-z\-]+$@', $input)) {
            return false;
        }

        if (preg_match('@^-|-$@', $input)) {
            return false;
        }

        return true;
    }
}

