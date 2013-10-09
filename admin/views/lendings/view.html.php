<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/views/lendings/view.html.php                    //
// @implements  : Class jSchuetzeViewlendings                           //
// @description : Main-entry for the lendings-ListView                  //
// Version      : 1.0.7                                                 //
// *********************************************************************//
// no direct access to this file
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport('joomla.application.component.view'); 

class jSchuetzeViewLendings extends JViewLegacy
{ 
    function display($tpl = null) 
    {
        // Add Toolbar to View
        $this->addToolbar();
        
        // Get data from the model
        $this->pagination = $this->get( 'Pagination' );
        $this->items	  = $this->get( 'Items' );
        $this->state      = $this->get( 'State' );

        // Get order state
        $this->listOrder = $this->escape($this->state->get( 'list.ordering'  ));
        $this->listDirn  = $this->escape($this->state->get( 'list.direction' ));

        // include custom fields
        require_once JPATH_COMPONENT .'/models/fields/member.php';
        
        parent::display($tpl); 
    } 

    function addToolbar()
    {
        // Set Headline
        JHtml::stylesheet('com_schuetze/views.css', array(), true, false, false);
        JToolBarHelper::title(   JText::_( 'COM_JSCHUETZE_HEAD_LENDINGS_MANAGER' ), 'jschuetze' );
        // Toolbar-Buttons
        JToolBarHelper::addNew('lending.add');
        JToolBarHelper::editList('lending.edit');
        JToolBarHelper::deleteList('COM_JSCHUETZE_DELETE_QUESTION', 'lendings.delete');
        JToolBarHelper::divider();
        JToolBarHelper::publishList('lendings.publish');
        JToolBarHelper::unpublishList('lendings.unpublish');
    }
    
    function getAddImage($rowID, $items) 
    {
        if ($items == 0){
            $ausgabe = '';
        } else {
            $ausgabe = '<a class="jgrid" style="padding-left:10px;" href="javascript:void(0);" onclick="return listItemTask(';
            $ausgabe .= ' \'cb'.$rowID.'\',\'lending.returnItem\')" title="'.JText::_('COM_JSCHUETZE_RETURN_ITEM').'"><img src="components/com_jschuetze/assets/images/plus.png"';
            $ausgabe .= 'border="0" alt="" /></a>';
        }
        return $ausgabe;
    }
} 
?>