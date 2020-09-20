<?php
//namespace Respect\Validation\Exceptions;

class JBlac_Validation_Exceptions_MacAddressException extends JBlac_Validation_Exceptions_ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a valid mac address',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a valid mac address',
        )
    );
}

