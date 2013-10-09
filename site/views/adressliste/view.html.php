<?php 
// *********************************************************************//
// Project      : jschuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/views/Adressliste/view.html.php                  //
// @implements  : Class jSchuetzeViewAdressliste                        //
// @description : Entry-File for the schuetze-Adresslisten-View         //
// Version      : 1.0.9                                                 //
// *********************************************************************//
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport('joomla.application.component.view'); 

class jSchuetzeViewAdressliste extends JViewLegacy
{ 
    
    function display($tpl = null) 
    { 
        $app                 = JFactory::getApplication();
        // Get the parameters
		$this->params        = $app->getParams();
        $this->model         = $this->getModel(); 
        switch($this->params->get('listkind'))
        {
            case 1: // Adressliste
                $this->content->text = $this->model->getAdressListe(false);
                break;
            case 2: // Bruderschaftsliste
                $this->content->text = $this->model->getBrotherhoodListe(false);
                break;
        }
        $this->menu          = $app->getMenu();
		$dispatcher	         =& JDispatcher::getInstance();

		// Process the content plugins.
		JPluginHelper::importPlugin('content');
		$results = $dispatcher->trigger('onContentPrepare', array ('com_jschuetze.adressliste', &$this->content, &$this->params, 0));

        parent::display($tpl); 
    } 


} 
?>