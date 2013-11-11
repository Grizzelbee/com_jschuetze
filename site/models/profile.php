<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/models/profilephp                                //
// @implements  : Class jSchuetzeModelProfile                           //
// @description : Model for the DB-Manipulation of jSchuetze            //
// Version      : 1.1.6                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted Access' ); 
// Include dependancy of the main model
jimport('joomla.application.component.model');

class jSchuetzeModelProfile extends JModelLegacy 
{ 
    
    function getData($jUserID) 
    { 
        $db = JFactory::getDBO(); 
        $query = $db->getQuery(true);

        $query->select('*');
        $query->from('#__jschuetze_mitglieder');
        $query->where('fk_juser = '.(int)$jUserID);
 
        $db->setQuery( $query ); 
        $user = $db->loadObject(); 

        return $user; 
    } 


    public function save($data)
    {
    	$data['geburtstag']            = JFactory::getDate($data['geburtstag'], 'UTC')->toMySQL();
    	$data['eintritt']              = JFactory::getDate($data['eintritt'], 'UTC')->toMySQL();
    	$data['eintritt_bruderschaft'] = JFactory::getDate($data['eintritt_bruderschaft'], 'UTC')->toMySQL();
    	
        $db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$query->update('#__jschuetze_mitglieder');
		$query->set('name = \''.$data[name].'\'');
		$query->set('vorname = \''.$data[vorname].'\'');
		$query->set('strasse = \''.$data[strasse].'\'');
		$query->set('plz = \''.$data[plz].'\'');
		$query->set('ort = \''.$data[ort].'\'');
		$query->set('tel = \''.$data[tel].'\'');
		$query->set('mobile = \''.$data[mobile].'\'');
		$query->set('email_priv = \''.$data[email_priv].'\'');
		$query->set('religion = \''.$data[religion].'\'');
		$query->set('geburtstag = \''.$data[geburtstag].'\'');
		$query->set('beitritt = \''.$data[eintritt].'\'');
		$query->set('beitritt_bruder = \''.$data[eintritt_bruderschaft].'\'');
		$query->set('scet_mail_notification = \''.$data[scet_mail_notification].'\'');
		$query->where('id = ' . (int)$data[id]);

		$db->setQuery((string) $query);

		if (!$db->query()) {
			JError::raiseError(500, $db->getErrorMsg());
		}
        
        if ((int)$data[change_joomla_mail] == 1)
        {
            $db		= $this->getDbo();
            $query	= $db->getQuery(true);
            $query->update('#__users');
            $query->set('email = \''.$data[email_priv].'\'');
            $query->where('id = ' . (int)$data[jUserID]);

            $db->setQuery((string) $query);

            if (!$db->query()) {
                JError::raiseError(500, $db->getErrorMsg());
            }
        }
    }

} 
?>