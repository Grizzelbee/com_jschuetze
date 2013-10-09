<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/controller.php (General-Controller-File)        //
// @implements  : Class jSchuetze-Controller                            //
// @description : General (Main-)Controller for the jSchuetze-Component //
// Version      : 1.0.0                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );
// import Joomla controller library
jimport( 'joomla.application.component.controller' );

class jSCHUETZEController extends JControllerLegacy
{
	function display($cachable = false)
	{
		// set default view if not set
		JRequest::setVar('view', JRequest::getCmd('view', 'members'));
 
		// call parent behavior
		parent::display($cachable);	
    }

}
