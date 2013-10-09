<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/views/title/view.html.php                       //
// @implements  : Class jSchuetzeViewtitle                              //
// @description : Main-entry for the single Title-View                  //
// Version      : 1.0.0                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted Access!');
jimport( 'joomla.application.component.view' );

class jSchuetzeViewTitle extends JViewLegacy
{
	/**
	 * display method of ToDo view
	 * @return void
	 **/
	function display($tpl = null)
	{
		$this->form = $this->get('Form');
        $this->item = $this->get('Item');
		$isNew	    = ($this->item->id == 0);

        $this->AddToolBar($isNew);
        
		parent::display($tpl);
	}
    
    protected function AddToolBar($isNew)
    {
		$text = $isNew ? JText::_( 'COM_JSCHUETZE_NEW' ) : JText::_( 'COM_JSCHUETZE_EDIT' );
        JHtml::stylesheet('com_jschuetze/views.css', array(), true, false, false);
		JToolBarHelper::title(   JText::_( 'COM_JSCHUETZE_HEAD_TITLES_MANAGER' ).': <small>[ ' . $text.' ]</small>' , 'jschuetze');
		JToolBarHelper::apply('title.apply');
        JToolBarHelper::save2new('title.save2new');
		JToolBarHelper::save('title.save');
		JToolBarHelper::cancel('title.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
    }
    
    
}
