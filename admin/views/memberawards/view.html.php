<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/views/memberawards/view.html.php                //
// @implements  : Class jSchuetzeViewMemberawards                       //
// @description : Main-entry for the memberawards-ListView              //
// Version      : 2.0.0                                                 //
// *********************************************************************//
// no direct access to this file
defined('_JEXEC') or die( 'Restricted Access' );
jimport('joomla.application.component.view');

class jSchuetzeViewMemberawards extends JViewLegacy
{
    function display($tpl = null)
    {
        // Get data from the model
        $this->pagination = $this->get( 'Pagination' );
        $this->items	     = $this->get( 'Items' );
        $this->state      = $this->get( 'State' );

        // Get order state
        $this->listOrder = $this->escape($this->state->get( 'list.ordering'  ));
        $this->listDirn  = $this->escape($this->state->get( 'list.direction' ));

        // include custom fields
        require_once JPATH_COMPONENT .'/models/fields/period.php';
        require_once JPATH_COMPONENT .'/models/fields/award.php';
        require_once JPATH_COMPONENT .'/models/fields/member.php';

        // Add Toolbar to View
        jschuetzeHelper::addSubmenu('memberawards');
        $this-> addToolbar();
        $this->sidebar = JHtmlSidebar::render();

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
        JToolBarHelper::deleteList('COM_JSCHUETZE_DELETE_QUESTION', 'memberawards.delete');
        JToolBarHelper::divider();
        JToolBarHelper::publishList('memberawards.publish');
        JToolBarHelper::unpublishList('memberawards.unpublish');
           JHtmlSidebar::setAction('index.php?option=com_jschuetze');

       JHtmlSidebar::addFilter(
          JText::_('JOPTION_SELECT_PUBLISHED'),
          'filter_published',
          JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true)
       );

       JHtmlSidebar::addFilter(
          JText::_('COM_JSCHUETZE_CHOOSE_MEMBER'),
          'filter_member',
          JHtml::_('select.options', JFormFieldMember::getOptions(), 'value', 'text', $this->state->get('filter.member'), true)
       );

       JHtmlSidebar::addFilter(
          JText::_('COM_JSCHUETZE_CHOOSE_AWARD'),
          'filter_award',
          JHtml::_('select.options', JFormFieldAward::getOptions(), 'value', 'text', $this->state->get('filter.award'), true)
       );

       JHtmlSidebar::addFilter(
          JText::_('COM_JSCHUETZE_CHOOSE_PERIOD'),
          'filter_period',
          JHtml::_('select.options', JFormFieldPeriod::getOptions(), 'value', 'text', $this->state->get('filter.period'), true)
       );
    }

   protected function getSortFields()
   {
      return array(
         'ordering' => JText::_('JGRID_HEADING_ORDERING'),
         'published' => JText::_('JSTATUS'),
         'member' => JText::_('COM_JSCHUETZE_MEMBER'),
         'award' => JText::_('COM_JSCHUETZE_AWARD'),
         'period' => JText::_('COM_JSCHUETZE_PERIOD'),
         'id' => JText::_('JGRID_HEADING_ID')
      );
   }

}
?>