<?php 
// *************************************************************************//
// Project      : jSchuetze for Joomla                                      //
// @package     : com_jSchuetze                                             //
// @file        : /admin/controllers/lending.php                            //
// @implements  : Class jSchuetzeControllerLending                          //
// @description : Controller for editing a single lending                   //
// Version      : 1.0.7                                                     //
// *************************************************************************//
// No direct access to this file 
defined('_JEXEC') or die('Restricted access');  
 // import Joomla controllerform library 
jimport('joomla.application.component.controllerform');  
 
// category Controller  
class jSchuetzeControllerLending extends JControllerForm
{  

    function returnItem()
    {
        $model = $this->getModel();
        $cid   = JRequest::getVar( 'cid', array(), 'post', 'array' );
        
        $this->setRedirect( 'index.php?option=com_jschuetze&view=lendings' );
        $result = $model->returnOneItem($cid[0]);
        
        if ($result == 1) {
            $this->setMessage( JText::_('COM_JSCHUETZE_MSG_ITEM_RETURNED' ));
        } else {
            JError::raiseWarning( 500, $this->getError() );
        }
    }
} 
?>