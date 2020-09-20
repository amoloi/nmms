<?php
//namespace Respect\Validation\Exceptions;

class JBlac_Validation_Exceptions_VersionException extends JBlac_Validation_Exceptions_ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a version',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a version',
        )
    );
}

