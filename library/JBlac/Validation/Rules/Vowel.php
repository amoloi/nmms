<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Vowel extends JBlac_Validation_Rules_AbstractRegexRule
{
    protected function getPregFormat()
    {
        return '/^(\s|[aeiouAEIOU])*$/';
    }
}

