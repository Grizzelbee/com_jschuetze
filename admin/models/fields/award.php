<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/models/fields/awards.php                        //
// @implements  : Class JFormFieldAward                                 //
// @description : Field to select one of the awards in jSchutze         //
// Version      : 1.0.0                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 
/**
 * categories Field
 *
 * @since		1.6
 */
class JFormFieldAward extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Awards';
 
	/**
	 * Method to get the field options.
	 *
	 * @return	array	The field option objects.
	 * @since	1.6
	 */
	public function getOptions()
	{
		$options = array();

        $db		= JFactory::getDbo();
        $query	= $db->getQuery(true);

        $query->select('id AS value, name AS text');
        $query->from('#__jschuetze_auszeichnungen');
        $query->order('ordering ASC');
     
        // Get the options.
        $db->setQuery($query);
     
        $options = $db->loadObjectList();

		return $options;
	}
}