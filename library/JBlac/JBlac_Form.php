<?php

class JBlac_Form extends Zend_Form
{

    public function __construct($options = null) {
        parent::__construct($options);
    
        $this->setAction($options['action']);
        $this->setMethod($options['method']);
        $this->setName($options['name']);
    }

}

