<?php
//namespace Respect\Validation\Exceptions;

class JBlac_Validation_Exceptions_TldException extends JBlac_Validation_Exceptions_ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT =>array(
            self::STANDARD => '{{name}} must be a valid top-level domain name',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a valid top-level domain name',
        )
    );
}

