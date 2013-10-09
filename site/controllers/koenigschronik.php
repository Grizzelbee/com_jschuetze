<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/controllers/koenigschronik.php                   //
// @implements  : jSchuetzeControllerKoenigschronik                     //
// @description : Special-Frontend-Controller-File                      //
//                for the jSchuetze-Component                           //
// Version      : 1.0.0                                                 //
// *********************************************************************//
// No direct access.
defined('_JEXEC') or die( 'Restricted Access' );
// Include dependancy of the main controllerform class
jimport('joomla.application.component.controllerform');
 
class jSchuetzeControllerKoenigschronik extends JControllerForm
{
 
        public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
        {
            return parent::getModel($name, $prefix, array('ignore_request' => false));
        }
 
}
?>