<?php

//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Exists extends JBlac_Validation_Rules_AbstractRule
{

    public function validate($input)
    {
        if ($input instanceof SplFileInfo) {
            $input = $input->getPathname();
        }

        return (is_string($input) && file_exists($input));
    }

}

