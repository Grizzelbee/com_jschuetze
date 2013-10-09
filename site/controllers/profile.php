<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/controllers/profile.php                          //
// @implements  : jSchuetzeControllerProfile                            //
// @description : Special-Frontend-Controller-File                      //
//                for the jSchuetze-Component                           //
// Version      : 1.1.3                                                 //
// *********************************************************************//
// No direct access.
defined('_JEXEC') or die( 'Restricted Access' );
// Include dependancy of the main controllerform class
jimport('joomla.application.component.controllerform');
 
class jSchuetzeControllerProfile extends JControllerForm
{
 
    public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, array('ignore_request' => false));
    }
 
    public function save()
    {
		// Redirect to the edit screen.
		$this->setRedirect(JRoute::_('index.php?option=com_jschuetze&view=profile', false));
        
        // Get the user data.
		//$data = JRequest::getVar(); // deprecated
        $jinput = JFactory::getApplication()->input;
        $data   = $jinput->getArray($_POST);

        $this->getModel()->save($data);

        // if ( !$this->getModel()->save($data) ){
            // JError::raiseWarning(1000, 'Datenbankfehler.');
        // };
    }
}
?>