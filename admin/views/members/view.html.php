<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/views/members/view.html.php                     //
// @implements  : Class jSchuetzeViewMembers                            //
// @description : Main-entry for the Members-ListView                   //
// Version      : 1.1.1                                                 //
// *********************************************************************//
// no direct access to this file
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport('joomla.application.component.view'); 

class jSchuetzeViewMembers extends JViewLegacy 
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
        JToolBarHelper::title(   JText::_( 'COM_JSCHUETZE_HEAD_MEMBERS_MANAGER' ), 'jschuetze' );
        // Toolbar-Buttons
        JToolBarHelper::addNew('member.add');
        JToolBarHelper::editList('member.edit');
        JToolBarHelper::deleteList('COM_JSCHUETZE_DELETE_QUESTION', 'members.delete');
        JToolBarHelper::divider();
        JToolBarHelper::publishList('members.publish');
        JToolBarHelper::unpublishList('members.unpublish');
        JToolBarHelper::divider();
        JToolBarHelper::publishList('members.scet_mail_notificationpublish', 'COM_JSCHUETZE_SCET_MAILS');
        JToolBarHelper::unpublishList('members.scet_mail_notificationunpublish', 'COM_JSCHUETZE_SCET_MAILS');

    }

} 
?>