<?php
//namespace Respect\Validation\Exceptions;

class JBlac_Validation_Exceptions_RegexException extends JBlac_Validation_Exceptions_ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must validate against {{regex}}',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not validate against {{regex}}',
        )
    );
}

