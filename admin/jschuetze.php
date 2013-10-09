<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/jschuetze.php (Joomla-Entry-File)               //
// @implements  :                                                       //
// @description : Main-Backend-Entry-File for the jSchuetze-Component   //
// Version      : 1.0.3                                                 //
// *********************************************************************//

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
define('_jSCHUETZE_VERSION','1.0.3');
 
// import joomla controller library
jimport('joomla.application.component.controller');
 
// Get an instance of the controller 
$controller = JControllerLegacy::getInstance('jSCHUETZE');
 
// Perform the Request task
$controller->execute(JRequest::getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();
?>