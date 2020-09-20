<?php

class Application_Form_SearchForm extends Zend_Form
{

    public function init()
    {
    }
    
    public function __construct($options = null) {
        parent::__construct($options);
        $this->addAttribs(array(
            'name'=>'searchForm',
            'class'=>'inline'
        ));
        
        $search = new Zend_Form_Element_Text('q');
        $search->setLabel('Search')
              ->setRequired();
        
        $submit = new Zend_Form_Element_Button('search');
        $submit->setLabel('Go')
                ->setAttribs(array(
                    'class'=>'btn btn-default'
                ));
        
                $this->addElements(array(
                    $search,
                    $submit,
                ));
    }


}

