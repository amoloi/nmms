<?php
//namespace Respect\Validation\Exceptions;

class JBlac_Validation_Exceptions_CallbackException extends JBlac_Validation_Exceptions_AbstractNestedException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be valid',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be valid',
        )
    );
}

