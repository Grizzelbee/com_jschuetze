<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/models/memberrank.php                          //
// @implements  : Class jSchuetzeModelMemberrank                       //
// @description : Model for the DB-Manipulation of a single             //
//                jSchuetze-memberrank; not for the list               //
// Version      : 1.0.0                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport( 'joomla.application.component.modeladmin' );

class jSchuetzeModelMemberrank extends JModelAdmin
{
   	var $_categories = null;

    
    /**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
    public function getTable($type = 'memberrank', $prefix = 'jSchuetzeTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
    
	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		Data for the form.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	mixed	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
        $form = $this->loadForm(
                'com_jschuetze.memberrank', 
                'memberrank', 
                 array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form))
        {
            return false;
        }
     
        return $form;
	}	
     
    /**
     * Method to get the data that should be injected in the form.
     *
     * @return      mixed   The data for the form.
     * @since       1.6
     */
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState('com_jschuetze.edit.memberrank.data', array());
        if (empty($data))
        {
            $data = $this->getItem();
            if ($data->funktion_seit == 0) {
            	$data->funktion_seit = '';
            }            
            if ($data->funktion_bis == 0) {
            	$data->funktion_bis = '';
            }            
        }
        return $data;	
    }
    
    public function save($data){
    	if ($data['funktion_seit'] == '') {
    		$data['funktion_seit'] = 0;
    	}else {
    		$data['funktion_seit']	= JFactory::getDate($data['funktion_seit'], 'UTC')->toSQL();
    	}
    	if ($data['funktion_bis'] == '') {
    		$data['funktion_bis'] = 0;
    	}else {
	    	$data['funktion_bis'] = JFactory::getDate($data['funktion_bis'], 'UTC')->toSQL();
    	}
    	 
    	return parent::save($data);
    }
}
?>