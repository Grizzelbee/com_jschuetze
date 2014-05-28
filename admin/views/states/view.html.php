<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/views/states/view.html.php                      //
// @implements  : Class jSchuetzeViewStates                             //
// @description : Main-entry for the state-ListView                     //
// Version      : 2.0.0                                                 //
// *********************************************************************//
// no direct access to this file
defined('_JEXEC') or die( 'Restricted Access' );
jimport('joomla.application.component.view');

class jSchuetzeViewStates extends JViewLegacy
{
    function display($tpl = null)
    {
        // Get data from the model
        $this->pagination = $this->get( 'Pagination' );
        $this->items	  = $this->get( 'Items' );
        $this->state      = $this->get( 'State' );

        // Get order state
        $this->listOrder = $this->escape($this->state->get( 'list.ordering'  ));
        $this->listDirn  = $this->escape($this->state->get( 'list.direction' ));

        // Add Toolbar to View
        jschuetzeHelper::addSubmenu('states');
        $this-> addToolbar();
        $this->sidebar = JHtmlSidebar::render();

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
        JToolBarHelper::deleteList('COM_JSCHUETZE_DELETE_QUESTION', 'state.delete');
        JToolBarHelper::divider();
        JToolBarHelper::publishList('state.publish');
        JToolBarHelper::unpublishList('state.unpublish');

       JHtmlSidebar::setAction('index.php?option=com_jschuetze');

       JHtmlSidebar::addFilter(
          JText::_('JOPTION_SELECT_PUBLISHED'),
          'filter_published',
          JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true)
       );

    }

   protected function getSortFields()
   {
      return array(
         'ordering' => JText::_('JGRID_HEADING_ORDERING'),
         'published' => JText::_('JSTATUS'),
      	 'name' => JText::_('COM_JSCHUETZE_STATE'),
         'id' => JText::_('JGRID_HEADING_ID')
      );
   }

}
?>