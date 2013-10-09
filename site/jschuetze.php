<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/jschuetze.php (Joomla-Entry-File)                //
// @implements  :                                                       //
// @description : Main-Frontend-Entry-File for the jSchuetze-Component  //
// Version      : 1.0.9                                                 //
// *********************************************************************//

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
define('_JSCHUETZE_VERSION','1.0.9');

// import joomla controller library
jimport('joomla.application.component.controller');
 
// Get an instance of the controller prefixed by jSchuetze
$controller = JControllerLegacy::getInstance('jschuetze');
 
// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();

?>
