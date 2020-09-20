<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Graph extends JBlac_Validation_Rules_AbstractCtypeRule
{
    protected function ctypeFunction($input)
    {
        return ctype_graph($input);
    }
}

