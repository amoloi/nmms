<?php
//namespace Respect\Validation\Exceptions;

class JBlac_Validation_Exceptions_AllOfException extends JBlac_Validation_Exceptions_AbstractGroupedException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::NONE => 'All of the required rules must pass for {{name}}',
            self::SOME => 'These rules must pass for {{name}}',
        ),
        self::MODE_NEGATIVE => array(
            self::NONE => 'None of these rules must pass for {{name}}',
            self::SOME => 'These rules must not pass for {{name}}',
        )
    );
}

