<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Digits extends JBlac_Validation_Rules_Digit
{
    public function __construct()
    {
        parent::__construct();
        trigger_error("Use digit instead.",
            E_USER_DEPRECATED);
    }
}
