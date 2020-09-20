<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initConfig()
        {

          $config = new Zend_Config($this->getOptions());
          Zend_Registry::set('config', $config);
        } 
     
        protected function _initViewHelpers(){
            $this->bootstrap('layout');
            $layout = $this->getResource('layout');
            $view = $layout->getView();
            $view->addHelperPath('../library/JBlac/View/Helper','JBlac_View_Helper_');
            $view->doctype('HTML5');
            
            $view->headMeta()->appendHttpEquiv('Content-type' , 'text/html;charset=utf-8')
                            ->appendName('description' , 'Namibia Transport Workers Union')
                            ->appendName('viewport' , 'width=device-width, initial-scale=1.0');
            $view->headTitle()->setSeparator(' :: ');
            $view->headTitle('NATAU-MMS');
            
            $navConfig = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml' ,'nav');
            $navContainer = new Zend_Navigation($navConfig);
            
            $view->navigation($navContainer);
        }

 protected function _initAutoload()
    {
        /*
         * If you don't register namespace
         * You will get error :
         * Fatal error: Class 'Example_Controller_Plugin_Param' not found in
         * ...\library\Zend\Application\Resource\Frontcontroller.php on line 92
         *
         */
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('JBlac_');
        $autoloader->suppressNotFoundWarnings(true);
        /*
         * also you will get Exception :
         * No entry is registered for key 'Zend_Request_Example'
         * called in helper ParamHelper.php
         *
         */
    }
    
    protected function _initControllerPlugins(){
	    $frontController = Zend_Controller_Front::getInstance();
	    $frontController->registerPlugin(new JBlac_Controller_Plugins_HeadScript());
	    $frontController->registerPlugin(new JBlac_Controller_Plugins_Acl());
    
    }

        protected function _initApplicationConstants(){
            if(!defined('ROOT_DIR')){
                
                define('ROOT_DIR',substr(APPLICATION_PATH, 0 , strlen(APPLICATION_PATH) - strlen('application')));
            } 
            if(!defined('UPLOAD_DIR')){
                
                define('UPLOAD_DIR',APPLICATION_PATH . '/../public/uploads/');
            }             

            if(!defined('TEMPLATES_DIR')){
                
                define('TEMPLATES_DIR',APPLICATION_PATH . '/../public/uploads/templates/');
            }
    }
   
    protected function _initSitekeys(){
        
        define('AUTH_KEY',        '/uI-m;ThG-M@j01U]>cy78xW/(GwvGsS/Y@Cw>A+Ug)X45:K+$585::a*U Fi-!@');
        define('SECURE_AUTH_KEY', 'j.8)#0@^N)-[a}S,tZ%T*;rTKW+e9(D <:A^F->A*aJR7+}-2BHR<NmJi_]-ZerL');
        define('LOGGED_IN_KEY',   '_-Lf?!XwJ2+zkK_b56jpFHD_PE4o|<lba45I(Iyc(K*~M~ar !J^/Y7RAf)rw1p?');
        define('NONCE_KEY',       'xX?oMj+0V@=}wX^m/.^hLL_9b%GP|;(Ei n|v+SmI}XKVKmZRs?0hNeu)]7f6_Np');
    }
    protected function _initDatabase() {
		
		define('DB_ADAPTER', 'Pdo_Mysql');
		define('DB_USERNAME', 'root');
		define('DB_PASSWORD', 'Mysql5.6');
		define('DB_NAME', 'ausklipc_nmms');
		define('DB_HOST', 'localhost');
		define('DB_DNS', "mysql:host=localhost;port=3306;dbname=ausklipc_nmms");

		try {
			$OPTIONS = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
			$connection = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD, $OPTIONS);
                        
                        $dbAdapter = new Zend_Db_Adapter_Pdo_Mysql(array('host'=>DB_HOST,
                                                 'username'=>DB_USERNAME,
                                                 'password'=>DB_PASSWORD,
                                                 'dbname'=>DB_NAME,));
                        
                        Zend_Registry::set('dba', $dbAdapter);
			Zend_Registry::set('dbh', $connection);
		} catch(PDOException $pde) {
			echo $pde -> getMessage();
                }
                

        }

    protected function _initSmtpMail()
        {
        //Create SMTP connection Object
           $configInfo = array('auth' => 'login',
                            'ssl' => 'tls',
                            'username' => 'silnamitsolutions@gmail.com',
                            'password' => 'S1ln4m@123',
                            'port' => '587');                
                           

            $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com',$configInfo);
            Zend_Mail::setDefaultTransport($transport);
            
            Zend_Registry::set('mailTransport', $transport);
         }
         protected function _initLov(){
            $dbh = Zend_Registry::get('dbh');
            $sql = 'select * from month_names_v';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $months = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($months as $key => $value) {
                $months_lov[strtolower($value['code'])] = $value['label'];
            }
            //Setting up a Cities/Towns list
            Zend_Registry::set('months' , $months_lov); 
            
            
            $sql = 'select * from sectors_lov_v';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $sectors = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($sectors as $key => $value) {
                $sectors_lov[strtolower($value['code'])] = $value['label'];
            }
            //Setting up a Cities/Towns list
            Zend_Registry::set('sectors' , $sectors_lov); 
            
            $sql = 'select * from companies_lov_v';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $companies = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($companies as $key => $value) {
                $companies_lov[strtolower($value['code'])] = $value['label'];
            }
            //Setting up a Cities/Towns list
            Zend_Registry::set('companies' , $companies_lov);             
         }

}

