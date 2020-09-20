<?php
//namespace Respect\Validation\Exceptions;

class JBlac_Validation_Exceptions_EndsWithException extends JBlac_Validation_Exceptions_ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must end with ({{endValue}})',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not end with ({{endValue}})',
        )
    );
}

