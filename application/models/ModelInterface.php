<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelInterface
 *
 * @author Innocent J Blac
 */
interface Application_Model_ModelInterface {
    
    /**
     * Delete a row from a table
     * @param table - Table name
     * @param id - ID of row
     * @return result
     */     
//    public function delete($table, $id){
//
//    } 
//    
    /**
     * Delete a row from a table
     * @param table - Table name
     * @param idName - name of the ID row
     * @param id - ID of row
     * @return result
     */
    function delete($table, $idName, $id);

    /**
     * Insert fields, values into Table
     * @param table - Table name
     * @param fields - Fields to insert
     * @param values - Values to insert
     */
    function insert( $table, $fields, $values );
    /**
     * Update fields, values into Table
     * @param table - Table name
     * @param fields - Fields to insert
     * @param values - Values to insert
     * @param idName - Name of Primary Key row
     * @param id - The unique identifier
     */
    function update( $table, $fields, $values, $idName, $id );
    
    /**
     * Use this for a SQL Query
     * Data is stored inside $this->lastResult 
     * @param sql - SQL to query the database
     */
    function query($sql);
    
    /**
     * Fetch rows from last query
     * @return row array
     */
    function fetchRow();
}