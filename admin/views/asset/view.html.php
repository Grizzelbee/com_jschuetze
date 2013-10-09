<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/views/asset/view.html.php                       //
// @implements  : Class jSchuetzeViewAsset                              //
// @description : Main-entry for the single Asset-View                  //
// Version      : 1.0.7                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted Access!');
jimport( 'joomla.application.component.view' );

class jSchuetzeViewAsset extends JViewLegacy
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
		JToolBarHelper::title(   JText::_( 'COM_JSCHUETZE_MANAGE_ASSETS' ).': <small>[ ' . $text.' ]</small>' , 'jschuetze');
		JToolBarHelper::apply('asset.apply');
        JToolBarHelper::save2new('asset.save2new');
		JToolBarHelper::save('asset.save');
		JToolBarHelper::cancel('asset.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
    }
    
    
}
