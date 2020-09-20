<?php
//namespace Respect\Validation\Exceptions;

class JBlac_Validation_Exceptions_EqualsException extends JBlac_Validation_Exceptions_ValidationException
{
    const EQUALS = 0;
    const IDENTICAL = 0;

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::EQUALS => '{{name}} must be equals {{compareTo}}',
            self::IDENTICAL => '{{name}} must be identical as {{compareTo}}',
        ),
        self::MODE_NEGATIVE => array(
            self::EQUALS => '{{name}} must not be equals {{compareTo}}',
            self::IDENTICAL => '{{name}} must not be identical as {{compareTo}}',
        )
    );

    public function chooseTemplate()
    {
        return $this->getParam('identical') ? static::IDENTICAL : static::EQUALS;
    }
}

