<?php
/**
 * Description of JBlac_View_Helper_Messenger
 *
 * @author Innocent
 */
class JBlac_View_Helper_NoticeHtmlList extends Zend_View_Helper_HtmlList{
    public function noticeHtmlList(array $items, $ordered = false, $attribs = false, $escape = true)
       {
           if (!is_array($items)) {
               require_once 'Zend/View/Exception.php';
               $e = new Zend_View_Exception('First param must be an array');
               $e->setView($this->view);
               throw $e;
           }

           $list = '';

           foreach ($items as $item) {
               if (!is_array($item)) {
                   if ($escape) {
                       $item = $this->view->escape($item);
                   }
                   $list .= '<li>' . $item . '</li>' . self::EOL;
               } else {
                   if (6 < strlen($list)) {
                       $list = substr($list, 0, strlen($list) - 6)
                        . $this->htmlList($item, $ordered, $attribs, $escape) . '</li>' . self::EOL;
                   } else {
                       $list .= '<li>' . $this->htmlList($item, $ordered, $attribs, $escape) . '</li>' . self::EOL;
                   }
               }
           }
           $containterAttribs = $attribs;

           if ($attribs) {
               $attribs = $this->_htmlAttribs($attribs);
           } else {
               $attribs = '';
           }

           if($containterAttribs['class'] == 'success_message'){
               $container = sprintf("<div class=%s><i class='%s'></i>" , 'success' , 'fa fa-check');
           }
           if($attribs == 'warning_message'){
               $containterAttribs['class'] = sprintf('<div class=%s><i class=%s></i>' , 'warning' , 'fa fa-warning');
           }
           if($attribs == 'info_message'){
               $containterAttribs['class'] = sprintf('<div class=%s><i class=%s></i>' , 'info' , 'fa fa-info');
           }
           if($attribs == 'error_message'){
               $containterAttribs['class'] = sprintf('<div class=%s><i class=%s></i>' , 'error' , 'fa fa-error');
           }
           
           $tag = 'ul';
           if ($ordered) {
               $tag = 'ol';
           }

           return "<" . $tag . $attribs . '>' . self::EOL . $list . '</' . $tag . '>' . self::EOL;
       }      
}