<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_NoneOf extends JBlac_Validation_Rules_AbstractComposite
{
    public function assert($input)
    {
        $exceptions = $this->validateRules($input);
        $numRules = count($this->getRules());
        $numExceptions = count($exceptions);
        if ($numRules !== $numExceptions) {
            throw $this->reportError($input)->setRelated($exceptions);
        }

        return true;
    }

    public function validate($input)
    {
        foreach ($this->getRules() as $rule) {
            if ($rule->validate($input)) {
                return false;
            }

        }
        return true;
    }
}

