<?php

//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Readable extends JBlac_Validation_Rules_AbstractRule
{

    public function validate($input)
    {
        if ($input instanceof SplFileInfo) {
            return $input->isReadable();
        }

        return (is_string($input) && is_readable($input));
    }

}

