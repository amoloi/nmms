<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Max extends JBlac_Validation_Rules_AbstractRule
{
    public $maxValue;
    public $inclusive;

    public function __construct($maxValue, $inclusive=false)
    {
        $this->maxValue = $maxValue;
        $this->inclusive = $inclusive;
    }

    public function validate($input)
    {
        if ($this->inclusive) {
            return $input <= $this->maxValue;
        } else {
            return $input < $this->maxValue;
        }
    }
}

