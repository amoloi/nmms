<?php


/**
 * ProfileLink helper
 *
 * Call as $this->profileLink() in your layout script
 */
/**
 * Description of JBlac_View_Helper_ProfileLink
 *
 * @author Innocent
 */
class JBlac_View_Helper_ProfileLink {
   public $view;

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function profileLink()
    {
        $auth = Zend_Auth::getInstance();
        Zend_Debug::dump($auth->getIdentity());
        if ($auth->hasIdentity()) {
            $fullName = $auth->getIdentity()->usr_username;
            $customerNumber = $auth->getIdentity()->CUSTOMER_NUMBER;
            return  "<a href='/customers/profile-edit/' class='profile pull-right text-muted small'>Welcome, $fullName <i class='fa fa-user'></i></a> [<a href='/customers/profile-edit/' class='profile pull-right text-muted small'>Welcome, $fullName <i class='fa fa-user'></i></a>]";
        } 

        return '<a href=\"/login\">Login</a>';
    }
}
