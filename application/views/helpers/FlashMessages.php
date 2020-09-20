<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlashMessages
 *
 * @author Innocent
 */
class Zend_View_Helper_FlashMessages
{
    /**
     * flashMessages function.     *
     * Takes a specially formatted array of flash messages and prepares them
     * for output.
     *
     * SAMPLE INPUT (in, say, a controller):     *    $this->_flashMessenger->addMessage(array('message' => 'Success message #1', 'status' => 'success'));
     *    $this->_flashMessenger->addMessage(array('message' => 'Error message #1', 'status' => 'error'));
     *    $this->_flashMessenger->addMessage(array('message' => 'Warning message #1', 'status' => 'warning'));
     *    $this->_flashMessenger->addMessage(array('message' => 'Success message #2', 'status' => 'success'));
     *     * SAMPLE OUTPUT (in a view):
     *    <div class="success">
     *        <ul>
     *            <li>Success message #1</li>
     *            <li>Success message #2</li>     *        </ul>
     *    </div>
     *    <div class="error">Error message #1</div>
     *    <div class="warning">Warning message #2</div>
     *     * @access public
     * @param $translator An optional instance of Zend_Translate
     * @return string HTML of output messages
     */
        public function flashMessages($translator = NULL)        {
                // Set up some variables, including the retrieval of all flash messages.
                $messages = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger')->getMessages();
                $statMessages = array();
                $output = '';        
                // If there are no messages, don't bother with this whole process.
                if (count($messages) > 0)
                {
                        // This chunk of code takes the messages (formatted as in the above sample                        // input) and puts them into an array of the form:
                        //    Array(
                        //        [status1] => Array(
                        //            [0] => "Message 1"
                        //            [1] => "Message 2"                        //        ),
                        //        [status2] => Array(
                        //            [0] => "Message 1"
                        //            [1] => "Message 2"
                        //        )                        //        ....
                        //    )
                        foreach ($messages as $message)
                        {
                            
                            if(is_array($message)){
                                if (!array_key_exists($message['status'], $statMessages))
                                    {
                                        $statMessages[$message['status']] = array();
                                    }

                                    if ($translator != NULL && $translator instanceof Zend_Translate)
                                    {
                                        array_push($statMessages[$message['status']], $translator->_($message['message']));
                                    }
                                    else 
                                    {
                                        array_push($statMessages[$message['status']], $message['message']);
                                    }
                                    
                                // This chunk of code formats messages for HTML output (per
                                // the example in the class comments).

                                foreach ($statMessages as $status => $messages)
                                {
                                        $output .= '<div class="alert alert-' . $status . '">';
                                        // If there is only one message to look at, we don't need to deal with                                // ul or li - just output the message into the div.
                                        if (count($messages) == 1){

                                            $output .= '<ul id="messages" class="icons">';
                                            $output .=  '<li>' . $messages[0]. '</li>';
                                            $output .= '</ul>';
                                        }

                                        // If there are more than one message, format it in the fashion of the                                // sample output above.
                                        else
                                        {
                                                $output .= "<ul id='messages' class='icons alert-{$status}'>";
                                                foreach ($messages as $message)
                                                {
                                                    $output .= '<li>' . $message . '</li>';
                                                }
                                                $output .= '</ul>';
                                        }

                                        $output .= '<a class="icon-remove" href="#close"></a></div>';

                                    }                                    
                                    
                            }else{
                                                $output .= '<div class="notice">';
                                                $output .= "<ul id='messages' class='icons genericmessage'>";
                                                $output .= '<li>' . $message . '</li>';
                                                $output .= '</ul>';
                                                $output .= '<a class="icon-remove" href="#close"></a></div>';                                
                            }

                        }

                        // Return the final HTML string to use.
                        return $output;
                }                
        }
}
//class Zend_View_Helper_FlashMessages extends Zend_View_Helper_Abstract
//{
//    public function flashMessages()
//    {
//        $messages = Zend_Controller_Action_HelperBroker::getStaticHelper('BipaFlashMessenger')->getMessages();
//        $output = '';
//       
//        if (!empty($messages)) {
//            $output .= '<ul id="messages">';
//            foreach ($messages as $message) {
//                $output .= '<li class="' . key($message) . '">' . current($message) . '</li>';
//            }
//            $output .= '</ul>';
//        }
//       
//        return $output;
//    }
//}
?>
