<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ecb_FileSystem
 *
 * @author Innocent J Blac
 */
class Ecb_FileSystem extends Upload_Storage_FileSystem {
    public function __construct($directory, $overwrite = false) {
        if (!is_dir($directory)){
                if (!mkdir($directory, 0777, true)) {
                    throw new InvalidArgumentException('Unable to create directory.');
                }             
        }
        if (!is_writable($directory)) {
            throw new InvalidArgumentException('Directory is not writable');
        }
        $this->directory = rtrim($directory, '/') . DIRECTORY_SEPARATOR;
        $this->overwrite = $overwrite;        
        
    }

}
