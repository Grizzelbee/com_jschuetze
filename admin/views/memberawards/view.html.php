<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/views/memberawards/view.html.php                //
// @implements  : Class jSchuetzeViewMemberawards                       //
// @description : Main-entry for the memberawards-ListView              //
// Version      : 1.0.0                                                 //
// *********************************************************************//
// no direct access to this file
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport('joomla.application.component.view'); 

class jSchuetzeViewMemberawards extends JViewLegacy
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
        JToolBarHelper::title(   JText::_( 'COM_JSCHUETZE_HEAD_MEMBERAWARDS_MANAGER' ), 'jschuetze' );
        // Toolbar-Buttons
        JToolBarHelper::addNew('memberaward.add');
        JToolBarHelper::editList('memberaward.edit');
        JToolBarHelper::deleteList('COM_SCHUETZE_DELETE_QUESTION', 'memberawards.delete');
        JToolBarHelper::divider();
        JToolBarHelper::publishList('memberawards.publish');
        JToolBarHelper::unpublishList('memberawards.unpublish');
    }

} 
?>