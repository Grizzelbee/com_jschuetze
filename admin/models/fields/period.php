<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/models/fields/period.php                        //
// @implements  : Class JFormFieldPeriod                                //
// @description : Field to select one of the Periods in the AwardsView  //
// Version      : 1.0.0                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 
class JFormFieldPeriod extends JFormFieldList
{     
	
	protected $type = 'Period';
 
	/**
	 * Method to get the field options.
	 * @return	array	The field option objects.
	 */
	public function getOptions()
	{
		$options = array();

        $db		= JFactory::getDbo();
        $query	= $db->getQuery(true);

        $query->select('periode AS value, periode AS text');
        $query->from('#__jschuetze_mitgliedsausz');
        $query->group('periode');
        $query->order('periode DESC');
     
        // Get the options.
        $db->setQuery($query);
        $options = $db->loadObjectList();

		return $options;
	}
}