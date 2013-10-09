<?php 
// *********************************************************************//
// Project      : jschuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/views/fundus/view.html.php                       //
// @implements  : Class jSchuetzeViewFundus                             //
// @description : Entry-File for the schuetze-Fundus-View               //
// Version      : 1.0.8                                                 //
// *********************************************************************//
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport('joomla.application.component.view'); 

class jSchuetzeViewFundus extends JViewLegacy
{ 
    
    function display($tpl = null) 
    { 
        $app                 = JFactory::getApplication();
        // Get the parameters
		$this->params        = $app->getParams();
        $this->model         = $this->getModel(); 
        $this->items         = $this->model->getFundus();
//		$this->content->text = $this->model->getMemberfiles($this->params);
        $this->menu          = $app->getMenu();
//		$dispatcher	         =& JDispatcher::getInstance();


		// Process the content plugins.
		// JPluginHelper::importPlugin('content');
		// $results = $dispatcher->trigger('onContentPrepare', array ('com_jschuetze.memberfiles', &$this->content, &$this->params, 0));

        parent::display($tpl); 
    } 

    
} 
?>