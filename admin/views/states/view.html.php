<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/views/states/view.html.php                      //
// @implements  : Class jSchuetzeViewStates                             //
// @description : Main-entry for the state-ListView                     //
// Version      : 1.0.0                                                 //
// *********************************************************************//
// no direct access to this file
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport('joomla.application.component.view'); 

class jSchuetzeViewStates extends JViewLegacy
{ 
    function display($tpl = null) 
    {
        // Add Toolbat to View
        $this->addToolbar();
        
        // Get data from the model
        $this->pagination = $this->get( 'Pagination' );
        $this->items	  = $this->get( 'Items' );
        $this->state      = $this->get( 'State' );

        // Get order state
        $this->listOrder = $this->escape($this->state->get( 'list.ordering'  ));
        $this->listDirn  = $this->escape($this->state->get( 'list.direction' ));
        
        parent::display($tpl); 
    } 

    function addToolbar()
    {
        // Set Headline
        JHtml::stylesheet('com_schuetze/views.css', array(), true, false, false);
        JToolBarHelper::title(   JText::_( 'COM_JSCHUETZE_HEAD_STATES_MANAGER' ), 'jschuetze' );
        // Toolbar-Buttons
        JToolBarHelper::addNew('state.add');
        JToolBarHelper::editList('state.edit');
        JToolBarHelper::deleteList('COM_SCHUETZE_DELETE_QUESTION', 'state.delete');
        JToolBarHelper::divider();
        JToolBarHelper::publishList('state.publish');
        JToolBarHelper::unpublishList('state.unpublish');
    }

} 
?>