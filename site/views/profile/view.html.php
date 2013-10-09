<?php 
// *********************************************************************//
// Project      : jschuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/views/profile/view.html.php                      //
// @implements  : Class jSchuetzeViewProfile                            //
// @description : Entry-File for the schuetze-Profile-View              //
// Version      : 1.1.3                                                 //
// *********************************************************************//
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport('joomla.application.component.view'); 

class jSchuetzeViewProfile extends JViewLegacy
{ 
    
    function display($tpl = null) 
    { 
        $app                 = JFactory::getApplication();
        // Get the parameters
		$this->params        = $app->getParams();
        $this->model         = $this->getModel(); 
        $this->user          = JFactory::getuser(); 
        $this->item          = $this->model->getData($this->user->id);
        // Testen 
        // $this->item = $this->get('Data');
        $this->menu          = $app->getMenu();

        parent::display($tpl); 
    } 

    
} 
?>