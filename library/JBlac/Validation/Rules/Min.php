<?php
//namespace Respect\Validation\Rules;

class JBlac_Validation_Rules_Min extends JBlac_Validation_Rules_AbstractRule
{
    public $inclusive;
    public $minValue;

    public function __construct($minValue, $inclusive=false)
    {
        $this->minValue = $minValue;
        $this->inclusive = $inclusive;
    }

    public function validate($input)
    {
        if ($this->inclusive) {
            return $input >= $this->minValue;
        } else {
            return $input > $this->minValue;
        }
    }
}

