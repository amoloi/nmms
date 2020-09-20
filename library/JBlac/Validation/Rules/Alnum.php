<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Alnum extends JBlac_Validation_Rules_AbstractCtypeRule
{
    protected function filter($input)
    {
        return $this->filterWhiteSpaceOption($input);
    }

    protected function ctypeFunction($input)
    {
        return ctype_alnum($input);
    }
}

