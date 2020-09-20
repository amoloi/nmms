<?php

class Application_Model_Referencetype extends Application_Model_Abstract
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
     * Active Flag to determine as to whether the the type is useful to admin users only
     * @param $active_f bool
     */
    protected  $admin_only_flag = false;
    
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
     * The user who created this record
     * @param $cuser string
     */
    protected $cuser = null;
    
    /*
     * The user who lastly edited this record
     * @param $muser string
     */
    protected $muser = null;
    
    /*
     * The date in-which this record was modified
     * $param $mdate , mysql  date
     */
    protected $mdate = 'NOW()';
   
    /*
     * The date in-which this record was created
     * $param $cdate , mysql  date
     */
    protected $cdate = 'NOW()';


//        `rtp_id`, 
//	`rtp_cd`, 
//	`rtp_desc`, 
//	`rtp_admin_only_f`, 
//	`rtp_cuser`, 
//	`rtp_cdate`, 
//	`rtp_muser`, 
//	`rtp_mdate`
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

    public function getAdmin_only_flag() {
        return $this->admin_only_flag;
    }

    public function setAdmin_only_flag($admin_only_flag) {
        $this->admin_only_flag = $admin_only_flag;
        return $this;
    }

    public function getErrorMessages() {
        return $this->errorMessages;
    }

    public function setErrorMessages($errorMessages) {
        $this->errorMessages = $errorMessages;
        return $this;
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }

    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    public function getCuser() {
        return $this->cuser;
    }

    public function setCuser($cuser) {
        $this->cuser = $cuser;
        return $this;
    }

    public function getMuser() {
        return $this->muser;
    }

    public function setMuser($muser) {
        $this->muser = $muser;
        return $this;
    }

    public function getMdate() {
        return $this->mdate;
    }

    public function setMdate($mdate) {
        $this->mdate = $mdate;
        return $this;
    }

    public function getCdate() {
        return $this->cdate;
    }

    public function setCdate($cdate) {
        $this->cdate = $cdate;
        return $this;
    }
    /*
     * Constructor function
     * @param options array eg options['db'] , options['type_cd']
     */
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

        public function __construct(array $options) {
        $this->db = $options['db'];
    }

        
    public function persistData(){
        $strSql = "INSERT INTO `ecb`.`rf_reference_types` 
                            ( 
                                `rtp_cd`, 
                                `rtp_desc`, 
                                `rtp_cdate`

                            )
                    VALUES
                            ( 
                                :rtp_cd, 
                                :rtp_desc,  
                                {$this->cdate}, 
                            )";
                
                $pStrSql = $this->db->prepare($strSql);             
                $pStrSql->bindParam(':rtp_cd' , $this->ref_rtp_cd , PDO::PARAM_STR);
                $pStrSql->bindParam(':rtp_desc' , $this->code , PDO::PARAM_STR);
                
                try{
                    $pStrSql->execute();
                    $this->setSuccessMessage('Record has been added successfully');
                    return TRUE;
                }  catch (PDOException $e){
                    $this->setErrorMessages('The System Is Unable to process your request for now ');
                    return false;
                   // exit($e->getMessage() . ' - ' . $e->getTrace());
                }
    }
    
    public function fetchAll(){

        $strSql =         "SELECT 	`rtp_id`, 
                                        `rtp_cd`, 
                                        `rtp_desc`, 
                                        `rtp_admin_only_f`,
                                        CASE `rtp_admin_only_f`
                                        WHEN 1 THEN 'Yes'
                                        WHEN 0 THEN 'No'
                                        END AS human_admin_f,
                                        `rtp_mdate`

                                        FROM 
                                        `ecb`.`rf_reference_types`";

                try{
                    $data = $this->db->query($strSql);

                    return $data->fetchAll(PDO::FETCH_ASSOC);
                    
                }  catch (PDOException $e){
                    $this->setErrorMessage('The System is Unable to Complete your request');
                    return false;
                }        
    }
    public function fetchOne($id) {
        $strSql =         "SELECT 	`rtp_id`, 
                                        `rtp_cd`, 
                                        `rtp_desc`, 
                                        `rtp_admin_only_f`,
                                        `rtp_mdate`

                            FROM 
                                        `ecb`.`rf_reference_types` 
                                        
                            WHERE rtp_id = :rtp_id";

                $pStrSql = $this->db->prepare($strSql);             
                $pStrSql->bindParam(':rtp_id' , $id , PDO::PARAM_INT);
                
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

        $strSql = "UPDATE `ecb`.`rf_reference_types` 
                    SET
                        `rtp_cd` = :rtp_cd, 
                        `rtp_desc` = :rtp_desc ,  
                        `rtp_mdate` = {$this->mdate}

                    WHERE
                        `rtp_id` = :rtp_id";
                
                $pStrSql = $this->db->prepare($strSql);             
                $pStrSql->bindParam(':rtp_cd' , $this->code , PDO::PARAM_STR);
                $pStrSql->bindParam(':rtp_desc' , $this->desc);
                $pStrSql->bindParam(':rtp_id' , $id , PDO::PARAM_INT);

                
                try{
                    $pStrSql->execute();
                    $this->setSuccessMessage('Record has been Updated successfully');
                    return TRUE;
                }  catch (PDOException $e){
                    $this->setErrorMessage('The System Is Unable to process your request for now ' . $e->getMessage());
                    return false;
                   // exit($e->getMessage() . ' - ' . $e->getTrace());
                }
    }

    public function statusChange($id){
        
        $strSql = "UPDATE `ecb`.`rf_reference_types` 
                    SET
                                `rtp_admin_only_f`    =   1 - `rtp_admin_only_f`, 
                                `rtp_mdate`     =   {$this->mdate}
	
                    WHERE           `rtp_id` = :rtp_id";

                $pStrSql = $this->db->prepare($strSql);             
                $pStrSql->bindParam(':rtp_id' , $id , PDO::PARAM_INT);
                
                try{
                    
                    $pStrSql->execute();
                    $this->setSuccessMessage('Record Active/Inactive Status has been Updated successfully');
                    return TRUE;
                    
                }  catch (PDOException $e){
                    
                    $this->setErrorMessages('The System Is Unable to process your request for now ');
                    return false;
                   // exit($e->getMessage() . ' - ' . $e->getTrace());
                }        
    }
}

