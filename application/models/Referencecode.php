<?php

class Application_Model_Referencecode extends Application_Model_Abstract
{

    /*
     * Database Connection
     * @param db resource of type pdo
     */
    protected $db = null;
    
    /*
     * Reference Code Code
     * @param $code string
     */
    protected $code = null;
    
    /*
     * Reference Code Description
     * @param $desc text/string
     */
    protected $desc = null;
    
    /*
     * Active Flag to determine as to whether the the code is useful
     * @param $active_f bool
     */
    protected  $active_flag = false;
    
    /*
     * This Class Error Messages Container
     * $param $errorMessages array
     */
    protected $errorMessages = array();
    protected $errorMessage = null;

        /*
     * This Class Success Messages Container
     * $param $successMessages array
     * $param $successMessage string 
     */
    protected $successMessages = array();
    protected $successMessage = null;
    /*
     * Foreign Key Reference type
     * $param $ref_rtp_cd bigint
     */
    protected $ref_rtp_cd = null;
    
    /*
     * Constructor function
     * @param options array eg options['db'] , options['type_cd']
     */

    public function __construct(array $options) {
        $this->db = $options['db'];
    }
    public function getDb() {
        return $this->db;
    }

    public function setDb($db) {
        $this->db = $db;
        return $this;
    }

    public function getCode() {
        return $this->code;
    }

    public function setCode($code) {
        $this->code = $code;
        return $this;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function setDesc($desc) {
        $this->desc = $desc;
        return $this;
    }

    public function getActive_flag() {
        return $this->active_flag;
    }

    public function setActive_flag($active_flag) {
        $this->active_flag = $active_flag;
        return $this;
    }

    public function getErrorMessages() {
        return $this->errorMessages;
    }

    public function setErrorMessages($errorMessage) {
        $this->errorMessages[] = $errorMessage;
        return $this;
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }

    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

        
    public function getRef_rtp_cd() {
        return $this->ref_rtp_cd;
    }

    public function setRef_rtp_cd($ref_rtp_cd) {
        $this->ref_rtp_cd = $ref_rtp_cd;
        return $this;
    }
    public function getSuccessMessages() {
        return $this->successMessages;
    }

    public function setSuccessMessages($successMessages) {
        $this->successMessages = $successMessages;
        return $this;
    }

    public function getSuccessMessage() {
        return $this->successMessage;
    }

    public function setSuccessMessage($successMessage) {
        $this->successMessage = $successMessage;
        return $this;
    }

            
    public function persistData(){
        $strSql = "INSERT INTO rf_reference_codes(
                                                  ref_rtp_cd,
                                                  ref_cd,
                                                  ref_desc,
                                                  ref_cdate
                                                  
                                                  )
                                         VALUES(
                                                  :ref_rtp_cd,
                                                  :ref_cd,
                                                  :ref_desc,
                                                  NOW()
                                         )";
                
                $pStrSql = $this->db->prepare($strSql);             
                $pStrSql->bindParam(':ref_rtp_cd' , $this->ref_rtp_cd , PDO::PARAM_STR);
                $pStrSql->bindParam(':ref_cd' , $this->code , PDO::PARAM_STR);
                $pStrSql->bindParam(':ref_desc' , $this->desc , PDO::PARAM_STR);

                
                try{
                    $pStrSql->execute();
                    $this->setSuccessMessage('Data Added Successfully');
                    return TRUE;
                }  catch (PDOException $e){
                    $this->setErrorMessages('The System Is Unable to process your request for now ');
                    return false;
                   // exit($e->getMessage() . ' - ' . $e->getTrace());
                }
    }
    
    public function fetchAll(){

        $strSql =         "SELECT 	`ref_rtp_cd`, 
                                        `ref_id`, 
                                        `ref_cd`, 
                                        `ref_desc`, 
                                        `ref_active_f`,
                                        CASE  `ref_active_f`
                                        WHEN 1 THEN 'Yes'
                                        WHEN 0 THEN 'No'
                                        END AS human_ref_status,
                                        `ref_mdate`

                                        FROM 
                                        `ecb`.`rf_reference_codes`";

                try{
                    $data = $this->db->query($strSql);

                    return $data->fetchAll(PDO::FETCH_ASSOC);
                    
                }  catch (PDOException $e){
                    $this->setErrorMessage('The System is Unable to Complete your request');
                    return false;
                }        
    }
    public function fetchOne($id) {
        $strSql =         "SELECT 	`ref_rtp_cd`, 
                                        `ref_id`, 
                                        `ref_cd`, 
                                        `ref_desc`, 
                                        `ref_active_f`,
                                        CASE  `ref_active_f`
                                        WHEN 1 THEN 'Yes'
                                        WHEN 0 THEN 'No'
                                        END AS human_ref_status,
                                        `ref_mdate`

                            FROM 
                                        `ecb`.`rf_reference_codes`
                            WHERE ref_id = :ref_id";

                $pStrSql = $this->db->prepare($strSql);             
                $pStrSql->bindParam(':ref_id' , $id , PDO::PARAM_INT);
                
                try{
                    $pStrSql->execute();
                    return $pStrSql->fetch(PDO::FETCH_ASSOC);
                    
                }  catch (PDOException $e){
                    $this->setErrorMessages('The System Is Unable to process your request for now ');
                    return false;
                   // exit($e->getMessage() . ' - ' . $e->getTrace());
                }       
    }
    
    public function update($id){

        $strSql = "UPDATE `ecb`.`rf_reference_codes` 
                    SET
                                `ref_rtp_cd`    =   :ref_rtp_cd, 
                                `ref_cd`        =   :ref_cd , 
                                `ref_desc`      =   :ref_desc , 
                                `ref_mdate`     =   NOW()
	
                WHERE           `ref_id` = :ref_id";
                
                $pStrSql = $this->db->prepare($strSql);             
                $pStrSql->bindParam(':ref_rtp_cd' , $this->ref_rtp_cd , PDO::PARAM_STR);
                $pStrSql->bindParam(':ref_cd' , $this->code , PDO::PARAM_STR);
                $pStrSql->bindParam(':ref_desc' , $this->desc , PDO::PARAM_STR);
                $pStrSql->bindParam(':ref_id' , $id , PDO::PARAM_INT);

                
                try{
                    $pStrSql->execute();
                    return TRUE;
                }  catch (PDOException $e){
                    $this->setErrorMessages('The System Is Unable to process your request for now ');
                    return false;
                   // exit($e->getMessage() . ' - ' . $e->getTrace());
                }
    }

    public function statusChange($id){
        
        $strSql = "UPDATE `ecb`.`rf_reference_codes` 
                    SET
                                `ref_active_f`    =   1 - `ref_active_f`, 
                                `ref_mdate`     =   NOW()
	
                WHERE           `ref_id` = :ref_id";
                
                $pStrSql = $this->db->prepare($strSql);             
                $pStrSql->bindParam(':ref_id' , $id , PDO::PARAM_INT);
                
                try{
                    
                    $pStrSql->execute();
                    return TRUE;
                    
                }  catch (PDOException $e){
                    
                    $this->setErrorMessages('The System Is Unable to process your request for now ');
                    return false;
                   // exit($e->getMessage() . ' - ' . $e->getTrace());
                }        
    }
}

