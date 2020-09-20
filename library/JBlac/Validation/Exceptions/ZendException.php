<?php
//namespace Respect\Validation\Exceptions;

class JBlac_Validation_Exceptions_ZendException extends JBlac_Validation_Exceptions_AbstractNestedException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}}',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}}',
        )
    );
}

