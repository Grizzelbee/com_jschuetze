<?php 
// *********************************************************************//
// Project      : jschuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/views/koenigschronik/view.html.php               //
// @implements  : Class jSchuetzeViewKoenigschronik                     //
// @description : Entry-File for the jToDo-Königschronik-View           //
// Version      : 1.0.6                                                 //
// *********************************************************************//
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport('joomla.application.component.view'); 

class jSchuetzeViewKoenigschronik extends JViewLegacy
{ 
    
    function display($tpl = null) 
    { 
        $app                 = JFactory::getApplication();
        
        // Get the parameters
		$this->params        = $app->getParams();
        $this->model         = $this->getModel(); 
        $this->kings         = $this->model->getChronicle($this->params);
        $this->menu          = $app->getMenu();
        
        parent::display($tpl); 
    } 

    
} 
?>