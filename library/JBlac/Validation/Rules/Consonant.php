<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Consonant extends JBlac_Validation_Rules_AbstractRegexRule
{
    protected function getPregFormat()
    {
        return '/^(\s|[b-df-hj-np-tv-zB-DF-HJ-NP-TV-Z])*$/';
    }
}

