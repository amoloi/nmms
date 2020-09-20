<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Digit extends JBlac_Validation_Rules_AbstractCtypeRule
{
    protected function filter($input)
    {
        return $this->filterWhiteSpaceOption($input);
    }

    protected function ctypeFunction($input)
    {
        return ctype_digit($input);
    }
}

