<?php
//namespace Respect\Validation\Rules;
//
//use Respect\Validation\Exceptions\ComponentException;

class JBlac_Validation_Rules_Charset extends JBlac_Validation_Rules_AbstractRule
{
    public $charset = null;

    public function __construct($charset)
    {
        $available = mb_list_encodings();
        $charset = is_array($charset) ? $charset : array($charset);
        $charset = array_filter($charset, function ($c) use ($available) {
            return in_array($c, $available, true);
        });

        if (!$charset) {
            throw new JBlac_Validation_Exceptions_ComponentException(
                'Invalid charset'
            );
        }
        $this->charset = $charset;
    }

    public function validate($input)
    {
        $detectedEncoding = mb_detect_encoding($input, $this->charset, true);

        return in_array($detectedEncoding, $this->charset, true);
    }
}

