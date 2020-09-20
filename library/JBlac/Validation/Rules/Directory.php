<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Directory extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        if ($input instanceof SplFileInfo) {
            return $input->isDir();
        }

        return (is_string($input) && is_dir($input));
    }
}

