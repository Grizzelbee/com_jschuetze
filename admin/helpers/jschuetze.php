<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/helpers/jschuetze.php (General-Helper-Class)    //
// @implements  : Class jSchuetzeHelper                                 //
// @description : General HelperClass for the jSchuetze-Component       //
// Version      : 2.0.0                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

class jschuetzeHelper extends JHelperContent
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string	The name of the active view.
	 *
	 * @return  void
	 * @since   1.6
	 */
	public static function addSubmenu($vName)
	{
        // known Views: members, memberawards, memberranks, lendings, assets, titles, states, awards, statistics
		JHtmlSidebar::addEntry(
			JText::_('COM_JSCHUETZE_SUBMENU_MEMBERDATA'),'', False
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_JSCHUETZE_SUBMENU_MEMBERS'),
			'index.php?option=com_jschuetze&view=members',
			$vName == 'members'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_JSCHUETZE_SUBMENU_MEMBERAWARDS'),
			'index.php?option=com_jschuetze&view=memberawards',
			$vName == 'memberawards'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_JSCHUETZE_SUBMENU_MEMBERRANKS'),
			'index.php?option=com_jschuetze&view=memberranks',
			$vName == 'memberranks'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_JSCHUETZE_SUBMENU_LENDINGS'),
			'index.php?option=com_jschuetze&view=lendings',
			$vName == 'lendings'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_JSCHUETZE_SUBMENU_STATISTICS'),
			'index.php?option=com_jschuetze&view=statistics',
			$vName == 'statistics'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_JSCHUETZE_SUBMENU_BASICS'),'', False
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_JSCHUETZE_SUBMENU_ASSETS'),
			'index.php?option=com_jschuetze&view=assets',
			$vName == 'assets'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_JSCHUETZE_SUBMENU_TITLES'),
			'index.php?option=com_jschuetze&view=titles',
			$vName == 'titles'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_JSCHUETZE_SUBMENU_STATES'),
			'index.php?option=com_jschuetze&view=states',
			$vName == 'states'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_JSCHUETZE_SUBMENU_AWARDS'),
			'index.php?option=com_jschuetze&view=awards',
			$vName == 'awards'
		);

	}
}