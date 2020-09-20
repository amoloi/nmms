<?php
//namespace Respect\Validation\Exceptions;

class JBlac_Validation_Exceptions_EachException extends JBlac_Validation_Exceptions_AbstractNestedException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => 'Each item in {{name}} must be valid',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => 'Each item in {{name}} must not validate',
        )
    );
}

