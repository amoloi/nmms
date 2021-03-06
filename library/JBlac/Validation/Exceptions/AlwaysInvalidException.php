<?php
//namespace Respect\Validation\Exceptions;

class JBlac_Validation_Exceptions_AlwaysInvalidException extends JBlac_Validation_Exceptions_ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} is always invalid',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} is always valid',
        )
    );
}

