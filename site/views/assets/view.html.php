<?php 
// *********************************************************************//
// Project      : jschuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/views/Assets/view.html.php                       //
// @implements  : Class jSchuetzeViewFundus                             //
// @description : Entry-File for the schuetze-Assets-View               //
// Version      : 1.1.4                                                 //
// *********************************************************************//
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport('joomla.application.component.view'); 

class jSchuetzeViewAssets extends JViewLegacy
{ 
	protected $params;

    function display($tpl = null) 
    { 
        $app = JFactory::getApplication();
        // Get the parameters
		$this->params   = $app->getParams();
        $this->model    = $this->getModel(); 
        $this->menu     = $app->getMenu();

        $this->items = $this->model->getFundus();

        parent::display($tpl); 
    } 
} 
?>