<?php
//namespace Respect\Validation\Exceptions;

class JBlac_Validation_Exceptions_MinimumAgeException extends JBlac_Validation_Exceptions_ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => 'The age must be {{age}} years or more.',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => 'The age must not be {{age}} years or more.',
        )
    );
}

