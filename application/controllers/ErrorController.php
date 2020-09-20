<?php

class ErrorController extends Zend_Controller_Action
{
    public function init()
    {
        $layout = $this->_helper->getHelper('layout');
        $layout->setLayout('www');
    }

    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        
        if (!$errors || !$errors instanceof ArrayObject) {
            $this->view->message = 'You have reached the error page';
            return;
        }
        
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                
               $exception = $errors->exception;
                $log = new Zend_Log(
                    new Zend_Log_Writer_Stream(
                        APPLICATION_PATH . '/logs/applicationException.log'
                    )
                );
                
                                $log->debug($exception->getMessage() . "\n" .
                            $exception->getTraceAsString());
                
                
                $this->getResponse()->setHttpResponseCode(404);
                $priority = Zend_Log::NOTICE;
                $this->view->message = 'Page not found';
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $priority = Zend_Log::CRIT;
                $this->view->message = 'Application error';
                
                // Log the exception:
                $exception = $errors->exception;
                $log = new Zend_Log(
                    new Zend_Log_Writer_Stream(
                        APPLICATION_PATH . '/applicationException.log'
                    )
                );
                $log->debug($exception->getMessage() . "\n" .
                            $exception->getTraceAsString());
                break;
        }
        
        // Log exception, if logger available
        if ($log = $this->getLog()) {
            $log->log($this->view->message, $priority, $errors->exception);
            $log->log('Request Parameters', $priority, $errors->request->getParams());
        }
        
        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }
        
        $this->view->request   = $errors->request;
    }

    public function getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }

    public function loginrequiredAction()
    {
        // action body
    }

    public function permissionrequiredAction()
    {
        // action body
    }


}



