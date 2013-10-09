<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/models/koenigschronik.php                        //
// @implements  : Class jSchuetzeModelKoenigschronik                    //
// @description : Model for the DB-Manipulation of the jSchuetze        //
// Version      : 1.1.0                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted Access' ); 
// Include dependancy of the main model
jimport('joomla.application.component.model');

class jSchuetzeModelKoenigschronik extends JModelLegacy 
{ 
    
    function getChronicle($params) 
    { 
        $db = JFactory::getDBO(); 
        $query = $db->getQuery(true);

        $query->select('member.vorname, award.titel, member.name, award.periode, award.foto_url as award_foto_url, member.foto_url as member_foto_url, zug');
        $query->from('#__jschuetze_mitglieder   AS member');
        $query->join('','#__jschuetze_mitgliedsausz  AS award  ON (award.fk_mitglied     = member.id)');
        $query->join('','#__jschuetze_auszeichnungen AS awards ON (award.fk_auszeichnung = awards.id)');
        //$query->where('member.published        = 1');
        if ($params->get('kind_of_king')==1){
            $query->where('awards.zugkoenig = 1');
        }
        if ($params->get('kind_of_king')==2){
            $query->where('awards.corpskoenig = 1');
        }
        if ($params->get('kind_of_king')==3){
            $query->where('awards.bruderkoenig = 1');
        }
        $query->order('award.auszeichnungsdatum '.$params->get('ordering'));

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