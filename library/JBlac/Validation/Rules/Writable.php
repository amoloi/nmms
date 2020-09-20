<?php

//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Writable extends JBlac_Validation_Rules_AbstractRule
{

    public function validate($input)
    {
        if ($input instanceof SplFileInfo) {
            return $input->isWritable();
        }
        return (is_string($input) && is_writable($input));
    }

}

