<?php

class AccountController extends Zend_Controller_Action
{

    public function init()
    {
        $layout = $this->_helper->getHelper('layout');
        $layout->setLayout('www');
        //$this->_helper->LoginRequired();
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->dbh = Zend_Registry::get('db');
        $this->dbadapter = Zend_Registry::get('dbAdapter');
        $this->errors = array();
        //Get the captcha in shape
        $captcha = new Zend_Captcha_Image ();
        $captcha->setImgDir(APPLICATION_PATH . '/../public/tmp/captcha/');
        $captcha->setImgUrl($this->view->baseUrl('/tmp/captcha/'));
        $captcha->setFont(APPLICATION_PATH . '/../public/fonts/elephant.ttf');
        $captcha->setWidth(350);
        $captcha->setHeight(100);
        $captcha->setWordlen(5);
        $captcha->setFontSize(60);
        $captcha->setLineNoiseLevel(4);
        $captcha->generate();
        $this->view->captcha = $captcha; // giving captcha object to the view
        

    }

    protected function getAuthAdapter($form_data)
    {
        //$dbadapter = Zend_Registry::get('dbAdapter');

        $authAdapter = new Zend_Auth_Adapter_DbTable($this->dbadapter);
        $authAdapter->setTableName('account')
                    ->setIdentityColumn('username')
                    ->setCredentialColumn('password');
        
        $strUsername    =   filter_var($form_data['username'], FILTER_SANITIZE_STRING);
        $strPassword    =   filter_var($form_data['password'], FILTER_SANITIZE_STRING);
        //echo $strUsername . ' - ' . $strPassword;exit;
            try {
                $authAdapter->setIdentity($strUsername)
                            ->setCredential(hash('sha256', $strPassword));
            } catch (Zend_Auth_Adapter_Exception $exc) {
                echo $exc->getMessage();
            }
            
            return $authAdapter;
    }

    public function authenticateAction()
    {
        $success = FALSE;
        $errors = array();
        $message = null;
        
        if($this->_request->isPost()){
            
            $errors = array();
            $form_data = $_POST;
            $mixedValidator = new Zend_Validate_Alnum();
            $validator = new Zend_Validate_Alpha(FALSE);
            $nullValidator = new Zend_Validate_NotEmpty();
            $emailValidator = new Zend_Validate_EmailAddress();
            $lengthValidator = new Zend_Validate_Between(array('min'=>6,
                                                               'max'=>15));
            $identicalValidator = new Zend_Validate_Identical();
            
            
            //Validating Username
            $username = filter_var($this->_request->getPost('username'), FILTER_SANITIZE_STRING);
            if($nullValidator->isValid($username)){
                if ($validator->isValid($username)){
                    $form_data['username'] = $username;
                }else{
                    $errors[] = 'Please Make sure the username doesn`t have spaces in between';   
                }                
            }else{
                $errors[] = 'Please provide username below';
            }
            
             //Validating Password
            $password = filter_var($this->_request->getPost('password'), FILTER_SANITIZE_STRING);
            
            if($nullValidator->isValid($password)){
                    $form_data['password'] = $password;
            }else{
                $errors[] = 'Please provide a password below';
            } 
            
            if(count($errors) > 0){
                
                $this->view->error = $errors;
                $this->forward('login');
                exit();
            }else{
             $adapter = $this->getAuthAdapter($form_data);
            $auth = Zend_Auth::getInstance();
            
            $result = $auth->authenticate($adapter);
            
            if($result->isValid()){
                $userdata = $adapter->getResultRowObject(null, array('usr_password'));
                $auth->getStorage()->write($userdata);
                
                $this->_flashMessenger->addMessage(array('message'=>Zend_Registry::get('config')->messages->login->successful, 'status'=>'success'));
                if($userdata->usr_role == Zend_Registry::get('config')->roles->admin){
                    $nextPage = '/admin/dashboard/';
                }else{
                    $nextPage = '/clients/myprofile/';
                }
                
            }  else {               
                $this->_flashMessenger->addMessage(array('message'=>'Login request Failed ','status'=>'error'));
                $nextPage = '/account/login';
            }               
            }
        }
        
        $this->_redirect($nextPage);
    }

    public function indexAction()
    {
        // action body
    }

    public function registerAction()
    {
        // Captcha business
        $capId = filter_input(INPUT_POST, 'cid', FILTER_SANITIZE_STRING);
        $capSession = new Zend_Session_Namespace('Zend_Form_Captcha_' . $capId);
        //Start the session account
        $registration_session = new Zend_Session_Namespace('registration');
        
        $errors = array();
        if(isset($registration_session->form_data)){
            $this->view->data = $registration_session->form_data;
        }
        if($this->_request->isPost()){
            $registration_session->form_data = $_POST;
            $this->view->data = $registration_session->form_data;
            
            //print_r($this->view->data);exit;
            $form_data = $_POST;
             if (filter_input(INPUT_POST, 'captcha', FILTER_SANITIZE_STRING) == $capSession->word) {
                //Go Ahead
            }else{
                $this->_flashMessenger->addMessage(array(
                    'message' =>'The verification code you supplied is Invalid. Please try again',
                    'status' => 'error'
                ));
                $this->redirect('account/register');
            }           

            $this->dbh->beginTransaction();
            $account = new Application_Model_Account($this->dbh);
            
            //Validating Input
            
            
            $validator = new Zend_Validate_Alpha(FALSE);
            $nullValidator = new Zend_Validate_NotEmpty();
            $emailValidator = new Zend_Validate_EmailAddress();
            $lengthValidator = new Zend_Validate_Between(array('min'=>6,
                                                               'max'=>15));
            $identicalValidator = new Zend_Validate_Identical();
            
            
            //Validating Username
            $username = filter_var($this->_request->getPost('username'), FILTER_SANITIZE_STRING);
            if($nullValidator->isValid($username)){
                if ($validator->isValid($username)){
                    $account->setUsername($username);
                }else{
                    $errors[] = 'Please Make sure the username doesn`t have spaces in between';   
                }                
            }else{
                $errors[] = 'Please provide username below';
            }
            
            //Validating Email Address
            $email = filter_var($this->_request->getPost('email_address'), FILTER_SANITIZE_STRING);
            if($nullValidator->isValid($email)){
                if ($emailValidator->isValid($email)){
                    $account->setEmail_address($email);
                }else{
                    $errors[] = 'Please Provide a valid E-mail address';   
                }                
            }else{
                $errors[] = 'Please provide E-mail Address below';
            }
            
             //Validating Password
            $password = filter_var($this->_request->getPost('password'), FILTER_SANITIZE_STRING);
            $cpassword = filter_var($this->_request->getPost('cpassword'), FILTER_SANITIZE_STRING);
            
            if($nullValidator->isValid($password) && $nullValidator->isValid($cpassword)){
                if ($lengthValidator->isValid(strlen($password)) && $lengthValidator->isValid(strlen($cpassword))){
                    $account->setPassword($password);
                }else{
                    $errors[] = 'Password and Confirm Password lengths must be between 6 and 15 characters';   
                }
            }else{
                $errors[] = 'Please provide a password and Confirm Password below';
            }          
            
    //Validating a person
              //Validating First Name
            $first_name = filter_var($this->_request->getPost('first_name'), FILTER_SANITIZE_STRING);
            if($nullValidator->isValid($first_name)){
                    $clean_data['first_name'] = $first_name;                  
            }else{
                $errors[] = 'Please provide First name below';
            }
            
      //Validating a person
              //Validating Last Name
            $last_name = filter_var($this->_request->getPost('last_name'), FILTER_SANITIZE_STRING);
            if($nullValidator->isValid($last_name)){
                    $clean_data['last_name'] = $last_name;
            }else{
                $errors[] = 'Please provide Last name below';
            } 
            //Validating a person
              //Validating Last Name
            $jobtitle = filter_var($this->_request->getPost('jobtitle'), FILTER_SANITIZE_STRING);
            if($nullValidator->isValid($jobtitle)){
                    $clean_data['jobtitle'] = $jobtitle;             
                
            }else{
                $errors[] = 'Please provide Job Title below';
            }           
            if(count($errors) > 0){
                
                $this->view->errors = $errors;
            }  else {
            $account->setCreated_by('Innocent');
            $account->createActivationCode();
            
            if($account->create()){
                $contact = new Application_Model_AddressContact($this->dbh);
                 $contact->setEmailAddress($form_data['email_address']);
                $person = new Application_Model_Person($this->dbh, $contact);
                
                if(array_key_exists('type', $form_data)){
                
                $contact->setCountry($form_data['country'])
                        ->setRegion($form_data['region'])
                        ->setCity($form_data['city'])
                        ->setConstituency($form_data['constituency'])
                        ->setPhysicalAddress($form_data['physical_address'])
                        ->setPostalAddress($form_data['postal_address'])
                        ->setTelphoneNumber($form_data['telphone_number'])
                        ->setMobileNumber($form_data['mobile_number'])
                        ->setFaxNumber($form_data['fax_number']);                          
                }

                $person->setFirst_name($clean_data['first_name'])
                        ->setLast_name($clean_data['last_name'])
                        ->setJob_title($clean_data['jobtitle'])
                        ->setAccount_id($account->getId())
                        ->setPhysical_address($contact->getPhysicalAddress())
                        ->setPostal_address($contact->getPostalAddress())
                        ->setCountry($contact->getCountry())
                        ->setRegion($contact->getRegion())
                        ->setCity($contact->getCity())
                        ->setConstituency($contact->getConstituency());
                if($person->insert()){
                    $this->dbh->commit();
                    Zend_Session::namespaceUnset('registration');
                    $this->sendAknowledgement(array(
                            'email'=>$contact->getEmailAddress(),
                            'activation_code'=>$account->getActivation_code(),
                            'username'=>$account->getUsername(),
                            'password'=>$account->getRaw_password(),
                            'firstname'=>$person->getFirst_name(),
                            'lastname'=>$person->getLast_name(),
                            'teaser'=>'Your ECB CLEMS Account has been created...',
                    ));
                    $this->_flashMessenger->addMessage(array('message'=>'Your information has been submitted', 'status'=>'success'));
                     
                    $this->redirect('account/success');
                }else{
                    $this->dbh->rollBack();
                     $this->_flashMessenger->addMessage(array('message'=>'The System in unable to process your request right now , please try again later', 'status'=>'success'));
                     
                     $this->redirect('account/register');
                }       
      
            }
            }           
        }
    }

    public function loginAction()
    {
        $layout = $this->_helper->getHelper('layout');
        $layout->setLayout('layout_single_column');
        $errors = array();
        
        if($this->_request->isPost()){
            
            
            $form_data = $_POST;
            $validator = new Zend_Validate_Alpha(FALSE);
            $nullValidator = new Zend_Validate_NotEmpty();
            $emailValidator = new Zend_Validate_EmailAddress();
            $lengthValidator = new Zend_Validate_Between(array('min'=>6,
                                                               'max'=>15));
            $identicalValidator = new Zend_Validate_Identical();
            
            
            //Validating Username
            $username = filter_var($this->_request->getPost('username'), FILTER_SANITIZE_STRING);
            if($nullValidator->isValid($username)){
                if ($validator->isValid($username)){
                    $form_data['username'] = $username;
                }else{
                    $errors[] = 'Please Make sure the username doesn`t have spaces in between';   
                }                
            }else{
                $errors[] = 'Please provide username below';
            }
            
             //Validating Password
            $password = filter_var($this->_request->getPost('password'), FILTER_SANITIZE_STRING);
            
            if($nullValidator->isValid($password)){
                    $form_data['password'] = $password;
            }else{
                $errors[] = 'Please provide a password and Confirm Password below';
            } 
            
            if(count($errors) > 0){
                
                $this->view->errors = $errors;

            }else{
             $adapter = $this->getAuthAdapter($form_data);
            $auth = Zend_Auth::getInstance();
            
            $result = $auth->authenticate($adapter);
            
            if($result->isValid()){
                $userdata = $adapter->getResultRowObject(null, array('password','activation_code','user_salt_hash'));

                $auth->getStorage()->write($userdata);                
                $this->_flashMessenger->addMessage(array('message'=>'You have successfuly loggedin', 'status'=>'success'));
                if(Zend_Registry::get('config')->roles->default ==  'C'){
                    $nextPage = '/account/myprofile/';
                }else{
                   
                    
                }
                
            }  else {               
                $this->_flashMessenger->addMessage(array('message'=>'Login request Failed ','status'=>'error'));
                $nextPage = '/account/login';
            }               
            }
            
            $this->_redirect($nextPage);
        }
        
    }

    public function logoutAction()
    {
        $errors = array();
       $auth = Zend_Auth::getInstance();
       $auth->clearIdentity();
       $this->_redirect('/');
    }

    public function myprofileAction()
    {
    $auth = Zend_Auth::getInstance();
    $registerUrl = $this->view->url(array('controller'=>'account','action'=>'register'), null, true);
    if ($auth->hasIdentity()) {
            $user_id = $auth->getIdentity()->id;

            $account = new Application_Model_Account($this->dbh);
            $account->setId($user_id);
            $this->view->account_data = $account->fetchRow();
        }
    }

    public function successAction()
    {
        // action body
    }

    public function activateAction()
    {
            $account = new Application_Model_Account($this->dbh);
            $account->setEmail_address($this->_request->getParam('email'))
                    ->setActivation_code($this->_request->getParam('ac'))
                    ->setModified_by('Innocent');
            $account_data = $account->fetchRelatedDetails();
            $errors = array();
            $emalValidator = new Zend_Validate_EmailAddress();
            if($emalValidator->isValid($this->_request->getParam('email'))){
                $ptions['email'] = $this->_request->getParam('email');
                $ptions['activation_code'] = $this->_request->getParam('ac');
            }else{
                $errors[] = 'Invalid Activation Mail';
            }
            
            if(count($errors) > 0){
                $this->view->email = $this->_request->getParam('email');
                $this->view->errors = $errors;
                return;
            }
            if(intval($account_data['is_active_flag']) == 1){
                    $this->_flashMessenger->addMessage(array(
                        'message' => 'Your ECB CLEMS account has already been activated , Please login below.',
                        'status' => 'notice'
                    ));
                    
                    $this->redirect('/account/login');
            }else{
                if( $account->activate()){
                 $this->sendActivationAknowledgement(array(
                 'email'=>$account_data['email_address'],
                 'username'=>$account_data['username'],
                 'firstname'=>$account_data['first_name'],
                 'lastname'=>$account_data['last_name'],
                 'teaser'=>'Your ECB CLEMS Account has been activated successfully !',));               
                }else{
                    exit('Unable to activate account');
                }                 
            }
      
    }

    private function sendAknowledgement($options = array (  'email' => NULL,  'activation_code' => NULL,  'username' => NULL,  'password' => NULL,  'firstname' => NULL,  'lastname' => NULL,  'teaser' => NULL,))
    {
        if ((!empty($options['username'])) && isset($options['username'])) {

                    $strAccountUrl = 'http://clems.ecb/account/activate/email/' . $options['email'] . '/ac/' . $options['activation_code'];

                    
                    if(file_exists(APPLICATION_PATH . '/../library/Ecb/Emails/email.tpl')){
                        $message = $file = file_get_contents(APPLICATION_PATH . '/../library/Ecb/Emails/email.tpl');
                    }else{
                        exit('Unable to send email');
                    }
                    $message_body = 'Thank you for registering with ECB CLEMS. Your registration details are:';

                    $message = str_replace('#TEASER#', $options['teaser'], $message);
                    $message = str_replace('#TITLE#', '', $message);
                    $message = str_replace('#SUBTITLE#', '', $message);
                    $message = str_replace('#GREETINGS#', 'Greetings,', $message);
                    $message = str_replace('#MESSAGE_BODY#', $message_body, $message);
                    $message = str_replace('#HYPER_LINK#', $strAccountUrl, $message);
                    $message = str_replace('#LINK_ACTION#', 'activate', $message);
                    $message = str_replace('#LINK_LABEL#', 'Activate My Account', $message);
                    $message = str_replace('#EMAIL_LABEL#', 'Email :', $message);
                    $message = str_replace('#EMAIL#', $options['email'], $message);
                    $message = str_replace('#USERNAME_LABEL#', 'Username :', $message);
                    $message = str_replace('#USERNAME#', $options['username'], $message);
                    $message = str_replace('#FULLNAME#', ucwords($options['firstname'] . ' ' . $options['lastname']), $message);
                    $message = str_replace('#PASSWORD_LABEL#', 'Password :', $message);
                    $message = str_replace('#PASSWORD#', $options['password'], $message);
                    $message = str_replace('#CURRENT_YEAR#', date('Y'), $message);
                    $message = str_replace('#COMPANY#', 'ECB NAMIBIA', $message);

                    $message = str_replace('#HYPER_LINK#', $strAccountUrl, $message);

                    //

                    $mailMsg = new Zend_Mail ();
                    $mailMsg->setBodyHtml($message);
                    $mailMsg->setFrom('silnamitsolutions@gmail.com', 'ECB CLEMS Online Registration System');
                    $mailMsg->addTo($options['email'], $options['firstname'] . ' ' . $options['lastname']);
                    $mailMsg->setSubject('Account Registration');

                    try {

                        $mailMsg->send(Zend_Registry::get('mailTransport'));
                    } catch (Zend_Mail_Exception $e) {

                        echo $e->getMessage();
                    }
                }
    }

    private function sendActivationAknowledgement($options = array (  'email' => NULL,  'username' => NULL,  'firstname' => NULL,  'lastname' => NULL,  'teaser' => NULL,))
    {
        if ((!empty($options['username'])) && isset($options['username'])) {

                $strLoginUrl = 'http://clems.ecb/account/login';
                $message = $file = file_get_contents(APPLICATION_PATH . '/../library/Ecb/Emails/activate.tpl');
                $message_body = 'Thank you for activating your ECB CLEMS account.';

                $message = str_replace('#TITLE#', $options['teaser'], $message);
                $message = str_replace('#SUBTITLE#', '', $message);
                $message = str_replace('#GREETINGS#', '', $message);
                $message = str_replace('#MESSAGE_BODY#', $message_body, $message);
                $message = str_replace('#HYPER_LINK#', $strLoginUrl, $message);
                $message = str_replace('#LINK_ACTION#', 'login', $message);
                $message = str_replace('#LINK_LABEL#', 'Login', $message);
                $message = str_replace('#EMAIL_LABEL#', '', $message);
                $message = str_replace('#EMAIL#', '', $message);
                $message = str_replace('#USERNAME_LABEL#','Your Username : ', $message);
                $message = str_replace('#USERNAME#', $options['username'], $message);
                $message = str_replace('#FULLNAME#', ucwords($options['firstname'] . ' ' . $options['lastname']), $message);
                $message = str_replace('#PASSWORD#', '', $message);
                $message = str_replace('#PASSWORD_LABEL#', '', $message);
                $message = str_replace('#CURRENT_YEAR#', date('Y'), $message);
                $message = str_replace('#COMPANY#', 'ECB NAMIBIA', $message);

                //

                $mailMsg = new Zend_Mail ();
                $mailMsg->setBodyHtml($message);
                $mailMsg->setFrom('silnamitsolutions@gmail.com', 'ECB CLEMS System');
                $mailMsg->addTo($options['email'], $options['firstname'] . ' ' . $options['lastname']);
                $mailMsg->setSubject('Account Activation');

                try {

                    $mailMsg->send(Zend_Registry::get('mailTransport'));

                    $this->_flashMessenger->addMessage(array(
                        'message' => 'Your ECB CLEMS account has been activated successfully, Please login below.',
                        'status' => 'success'
                    ));
                    $this->_helper->redirector('login');
                } catch (Zend_Mail_Exception $e) {

                    echo $e->getMessage();
                }
                }
    }

    public function recovermyusernameAction()
    {
        // action body
    }

    public function resetrmypasswordAction()
    {
        // action body
    }


}

















