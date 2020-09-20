<?php
//namespace Respect\Validation\Rules;
//
//use Respect\Validation\Validatable;
//use Respect\Validation\Exceptions\ValidationException;

class JBlac_Validation_Rules_Not extends JBlac_Validation_Rules_AbstractRule
{
    public $rule;

    public function __construct(JBlac_Validation_Validatable $rule)
    {
        if ($rule instanceof JBlac_Validation_Rules_AbstractComposite) {
            $rule = $this->absorbComposite($rule);
        }

        $this->rule = $rule;
    }

    public function validate($input)
    {
        if ($this->rule instanceof JBlac_Validation_Rules_AbstractComposite) {
            return $this->rule->validate($input);
        }

        return!$this->rule->validate($input);
    }

    public function assert($input)
    {
        if ($this->rule instanceof JBlac_Validation_Rules_AbstractComposite) {
            return $this->rule->assert($input);
        }

        try {
            $this->rule->assert($input);
        } catch (JBlac_Validation_Exceptions_ValidationException $e) {
            return true;
        }

        throw $this->rule
            ->reportError($input)
            ->setMode(JBlac_Validation_Exceptions_ValidationException::MODE_NEGATIVE);
    }

    protected function absorbComposite(JBlac_Validation_Rules_AbstractComposite $rule)
    {
        $clone = clone $rule;
        $rules = $clone->getRules();
        $clone->removeRules();

        foreach ($rules as &$r) {
            if ($r instanceof JBlac_Validation_Rules_AbstractComposite) {
                $clone->addRule($this->absorbComposite($r));
            } else {
                $clone->addRule(new static($r));
            }
        }

        return $clone;
    }
}

