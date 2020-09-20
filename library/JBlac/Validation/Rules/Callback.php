<?php
//namespace Respect\Validation\Rules;
//
//use Respect\Validation\Exceptions\ComponentException;

class JBlac_Validation_Rules_Callback extends JBlac_Validation_Rules_AbstractRule
{
    public $callback;

    public function __construct($callback)
    {
        if (!is_callable($callback)) {
            throw new JBlac_Validation_Exceptions_ComponentException('Invalid callback');
        }

        $this->callback = $callback;
    }

    public function validate($input)
    {
        return (bool) call_user_func($this->callback, $input);
    }
}

