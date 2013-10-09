<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/models/fields/member.php                        //
// @implements  : Class JFormFieldMember                                //
// @description : Field to select one of the Members in jSchutze        //
// Version      : 1.0.0                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 
class JFormFieldMember extends JFormFieldList
{
	protected $type = 'Member';
 
	/**
	 * Method to get the field options.
	 * @return	array	The field option objects.
	 */
	public function getOptions()
	{
		$options = array();

        $db		= JFactory::getDbo();
        $query	= $db->getQuery(true);

        $query->select("id AS value, CONCAT(name, ', ', vorname) AS text");
        $query->from('#__jschuetze_mitglieder');
        //$query->where('published = 1');
        $query->order('name ASC');
     
        // Get the options.
        $db->setQuery($query);
     
        $options = $db->loadObjectList();
        $options = array_merge_recursive(array("text"=>JText::_('COM_JSCHUETZE_CHOOSE_MEMBER')), $options);

		return $options;
	}
}