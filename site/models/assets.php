<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/models/assets.php                                //
// @implements  : Class jSchuetzeModelAssets                            //
// @description : Model for the DB-Manipulation of jSchuetze            //
// Version      : 1.1.4                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted Access' ); 
// Include dependancy of the main model
jimport('joomla.application.component.model');

class jSchuetzeModelAssets extends JModelLegacy 
{ 
    
    public function getFundus() 
    { 
        $db = JFactory::getDBO(); 
        $query = $db->getQuery(true);

        $query->select('*');
        $query->from('#__jschuetze_fundus');
        $query->where('published = 1');
        $query->order('ordering');

        $db->setQuery( $query ); 
        $rows = $db->loadObjectList(); 

        return $rows; 
    } 

    public function setPagehit($viewname)
    {
        $db = JFactory::getDBO(); 
        
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__jschuetze_statistics');
        $query->where('viewname = \''.$viewname.'\'');
        
        $db->setQuery( $query ); 
        $row = $db->loadObject(); 
        
        if (empty($row)) {
            $row = (object) array("id"=>null, "viewname"=>"$viewname", "hits"=>"1");
            $db->insertObject('#__jschuetze_statistics', $row, 'id');
        } else {
            $row->hits++;
            $db->updateObject('#__jschuetze_statistics', $row, 'id');
        };
    }

} 
?>