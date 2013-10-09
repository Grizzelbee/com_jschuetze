<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/views/memberranks/view.html.php                 //
// @implements  : Class jSchuetzeViewMemberranks                        //
// @description : Main-entry for the memberranks-ListView               //
// Version      : 1.0.0                                                 //
// *********************************************************************//
// no direct access to this file
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport('joomla.application.component.view'); 

class jSchuetzeViewMemberranks extends JViewLegacy
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
        
        // include custom fields
        require_once JPATH_COMPONENT .'/models/fields/rank.php';
        require_once JPATH_COMPONENT .'/models/fields/member.php';

        parent::display($tpl); 
    } 

    function addToolbar()
    {
        // Set Headline
        JHtml::stylesheet('com_schuetze/views.css', array(), true, false, false);
        JToolBarHelper::title(   JText::_( 'COM_JSCHUETZE_HEAD_MEMBERRANKS_MANAGER' ), 'jschuetze' );
        // Toolbar-Buttons
        JToolBarHelper::addNew('memberrank.add');
        JToolBarHelper::editList('memberrank.edit');
        JToolBarHelper::deleteList('COM_JSCHUETZE_DELETE_QUESTION', 'memberranks.delete');
        JToolBarHelper::divider();
        JToolBarHelper::publishList('memberranks.publish');
        JToolBarHelper::unpublishList('memberranks.unpublish');
    }

} 
?>