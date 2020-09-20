<?php
//namespace Respect\Validation\Rules;

abstract class JBlac_Validation_Rules_AbstractRegexRule extends JBlac_Validation_Rules_AbstractFilterRule
{
    abstract protected function getPregFormat();

    public function validateClean($input)
    {
        return preg_match($this->getPregFormat(), $input);
    }
}

