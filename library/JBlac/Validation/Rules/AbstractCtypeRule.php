<?php
//namespace Respect\Validation\Rules;

abstract class JBlac_Validation_Rules_AbstractCtypeRule extends JBlac_Validation_Rules_AbstractFilterRule
{
    abstract protected function ctypeFunction($input);

    protected function filterWhiteSpaceOption($input)
    {
        if (!empty($this->additionalChars))
            $input = str_replace(str_split($this->additionalChars), '', $input);
        return preg_replace('/\s/', '', $input);
    }

    public function validateClean($input)
    {
        return $this->ctypeFunction($input);
    }
}

