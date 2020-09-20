<?php
//namespace Respect\Validation\Rules;

/**
 * @link http://semver.org/
 */
class JBlac_Validation_Rules_Version extends JBlac_Validation_Rules_AbstractRule
{
    public function validate($input)
    {
        $pattern = '/^[0-9]+\.[0-9]+\.[0-9]+([+-][^+-][0-9A-Za-z-.]*)?$/';

        return (bool) preg_match($pattern, $input);
    }
}

