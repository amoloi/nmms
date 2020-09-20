<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Instance extends JBlac_Validation_Rules_AbstractRule
{
    public $instanceName;

    public function __construct($instanceName)
    {
        $this->instanceName = $instanceName;
    }

    public function reportError($input, array $extraParams=array())
    {
        return parent::reportError($input, $extraParams);
    }

    public function validate($input)
    {
        return $input instanceof $this->instanceName;
    }
}

