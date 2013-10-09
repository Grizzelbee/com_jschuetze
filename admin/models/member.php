<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/models/member.php                               //
// @implements  : Class jSchuetzeModelMember                            //
// @description : Model for the DB-Manipulation of a single             //
//                jSchuetze-Member; not for the list                    //
// Version      : 2.5.18                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport( 'joomla.application.component.modeladmin' );

class jSchuetzeModelMember extends JModelAdmin
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
    public function getTable($type = 'Member', $prefix = 'jSchuetzeTable', $config = array())
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
                'com_jschuetze.member', 
                'member', 
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
        $data = JFactory::getApplication()->getUserState('com_jschuetze.edit.member.data', array());
        if (empty($data))
        {
            $data = $this->getItem();
            
            if ($data->ordering == 0)
            {
                $data->ordering = $this->getNextOrderingNr();
            }
        }
        return $data;	
    }
    
    function getNextOrderingNr()
    {
        $db    = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('MAX(ordering)');
        $query->from('#__jschuetze_mitglieder');
		$db->setQuery( $query );
		$maxOrdering = $db->loadResult();

		return ($maxOrdering + 1)  ;
	}
    
    
    public function setScetmailNotificationState($newState, $users)
    {
        $db    = JFactory::getDBO();
        $query = $db->getQuery(true);

        $cids = implode(',', $users);
        
        $sql = 'UPDATE #__jschuetze_mitglieder '
              .'SET scet_mail_notification = '.(int)$newState
              .' WHERE id IN ('.$cids.')';
        
        $db->setQuery($sql);
        $db->query();
        
        return $db->getAffectedRows();
    }
    
    
    
}
?>