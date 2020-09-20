<?php
//namespace Respect\Validation\Rules;
//
//use Respect\Validation\Exceptions\ValidationException;
//use Respect\Validation\Validatable;
//use Respect\Validation\Validator;

abstract class JBlac_Validation_Rules_AbstractComposite extends JBlac_Validation_Rules_AbstractRule
{
    protected $rules = array();

    public function __construct()
    {
        $this->addRules(func_get_args());
    }

    public function addRule($validator, $arguments=array())
    {
        if (!$validator instanceof JBlac_Validation_Validatable) {
            $this->appendRule(JBlac_Validation_Validator::buildRule($validator, $arguments));
        } else {
            $this->appendRule($validator);
        }

        return $this;
    }

    public function removeRules()
    {
        $this->rules = array();
    }

    public function addRules(array $validators)
    {
        foreach ($validators as $key => $spec) {
            if ($spec instanceof JBlac_Validation_Validatable) {
                $this->appendRule($spec);
            } elseif (is_numeric($key) && is_array($spec)) {
                $this->addRules($spec);
            } elseif (is_array($spec)) {
                $this->addRule($key, $spec);
            } else {
                $this->addRule($spec);
            }
        }

        return $this;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function hasRule($validator)
    {
        if (empty($this->rules)) {
            return false;
        }

        if ($validator instanceof JBlac_Validation_Validatable) {
            return isset($this->rules[spl_object_hash($validator)]);
        }

        if (is_string($validator)) {
            foreach ($this->rules as $rule) {
                if (get_class($rule) == __NAMESPACE__ . '\\' . $validator) {
                    return true;
                }
            }
        }

        return false;
    }

    protected function appendRule(JBlac_Validation_Validatable $validator)
    {
        $this->rules[spl_object_hash($validator)] = $validator;
    }

    protected function validateRules($input)
    {
        $validators = $this->getRules();
        $exceptions = array();
        foreach ($validators as $v) {
            try {
                $v->assert($input);
            } catch (JBlac_Validation_Exceptions_ValidationException $e) {
                $exceptions[] = $e;
            }
        }

        return $exceptions;
    }
}

