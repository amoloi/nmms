<?php
class Zend_View_Helper_LoggedInUser extends Zend_View_Helper_Abstract {

    protected $_view;

    function setView(Zend_View_Interface $view) {
        $this->_view = $view;
    }

    function loggedInUser() {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $logoutUrl = '/authentication/logout';
            $user = $auth->getIdentity()->usr_username;
            $username = ucfirst($user);
            $string = 'Logged in as ' . $username . ' | <a href="' . $logoutUrl . '"><i class="fa fa-unlock"></i> Log out</a>';
        } else {
            $loginUrl = '/admin';
            $string = '<a href="' . $loginUrl . '">Log in</a>';
        }
        return $string;
    }

}
?>
