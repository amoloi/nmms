<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Consonants extends JBlac_Validation_Rules_Consonant
{
    public function __construct()
    {
        parent::__construct();
        trigger_error("Use consonant instead.",
            E_USER_DEPRECATED);
    }
}
