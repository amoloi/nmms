<?php

//namespace Respect\Validation\Exceptions;

class JBlac_Validation_Exceptions_WritableException extends JBlac_Validation_Exceptions_ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be an uploaded file',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be an uploaded file',
        )
    );

}
