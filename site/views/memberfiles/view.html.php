<?php 
// *********************************************************************//
// Project      : jschuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/views/memberfiles/view.html.php                  //
// @implements  : Class jSchuetzeViewMemebrfiles                        //
// @description : Entry-File for the schuetze-Standard-View             //
// Version      : 1.1.4                                                 //
// *********************************************************************//
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport('joomla.application.component.view'); 

class jSchuetzeViewMemberfiles extends JViewLegacy
{ 
    protected $content;
    
    function display($tpl = null) 
    { 
        $app = JFactory::getApplication();
        // Get the parameters
		$this->params        = $app->getParams();
        $this->model         = $this->getModel(); 
        $this->content       = new StdClass();
		$this->content->text = $this->model->getMemberfiles($this->params);
        $this->menu          = $app->getMenu();
		$dispatcher	         = JDispatcher::getInstance();

		// Process the content plugins.
		JPluginHelper::importPlugin('content');
		$results = $dispatcher->trigger('onContentPrepare', array ('com_jschuetze.memberfiles', &$this->content, &$this->params, 0));

        parent::display($tpl); 
    } 

    
} 
?>