<?php
//namespace Respect\Validation\Exceptions;

class JBlac_Validation_Exceptions_PunctException extends JBlac_Validation_Exceptions_AlphaException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must contain only punctuation characters',
            self::EXTRA => '{{name}} must contain only punctuation characters and "{{additionalChars}}"'
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not contain punctuation characters',
            self::EXTRA => '{{name}} must not contain punctuation characters or "{{additionalChars}}"'
        )
    );
}

