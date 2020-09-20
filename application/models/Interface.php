<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Interface
 *
 * @author Innocent J Blac
 */
interface Application_Model_Interface {

    public function insert();
    public function update($value);
    public function fetchAll();
    public function fetchOne($value);
    public function delete($value);
}
