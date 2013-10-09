<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/models/fields/asset.php                         //
// @implements  : Class JFormFieldAsset                                 //
// @description : Field to select one of the Assets in jSchutze         //
// Version      : 1.0.7                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 
class JFormFieldAsset extends JFormFieldList
{
	protected $type = 'asset';
 
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
        $query->from('#__jschuetze_fundus');
        $query->where('published = 1');
        $query->order('name ASC');
     
        // Get the options.
        $db->setQuery($query);
     
        $options = $db->loadObjectList();

		return $options;
	}
}