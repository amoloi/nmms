<?php

//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_File extends JBlac_Validation_Rules_AbstractRule
{

    public function validate($input)
    {
        if ($input instanceof SplFileInfo) {
            return $input->isFile();
        }

        return (is_string($input) && is_file($input));
    }

}

