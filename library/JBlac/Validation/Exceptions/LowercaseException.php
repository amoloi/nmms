<?php
//namespace Respect\Validation\Exceptions;

class JBlac_Validation_Exceptions_LowercaseException extends JBlac_Validation_Exceptions_ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be lowercase',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be lowercase',
        )
    );
}

