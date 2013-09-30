<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/models/fields/rank.php                          //
// @implements  : Class JFormFieldRank                                  //
// @description : Field to select one of the Ranks in jSchutze          //
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
class JFormFieldRank extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Rank';
 
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
        $query->from('#__jschuetze_titel');
        $query->where('rank      = 1');
        $query->where('published = 1');
        $query->order('name ASC');
     
        // Get the options.
        $db->setQuery($query);
     
        $options = $db->loadObjectList();
        //$options = array_merge_recursive((object) array("id"=>0, "name"=>null, "rank"=>1, "published"=>1, "ordering"=>0), $options);
        $options = array_merge_recursive(array("text"=>null), $options);

		return $options;
	}
}