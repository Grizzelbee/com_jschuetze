<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/models/jschuetze.php                             //
// @implements  : Class jSchuetzeModeljSchuetze                         //
// @description : Model for the DB-Manipulation of the jSchuetze        //
// Version      : 1.0.0                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted Access' ); 
// Include dependancy of the main model
jimport('joomla.application.component.model');

class jSchuetzeModelMemberfiles extends JModelLegacy 
{ 
    
    function getMembersForMemberfile() 
    { 
        $db = JFactory::getDBO(); 
        $query = $db->getQuery(true);

        $query->select('member.*, rank.name AS rang, function.name AS funktion, state.name AS status, memberrank.funktion_seit, memberrank.funktion_bis');
        $query->from('#__jschuetze_mitglieder AS member');
        $query->join('','#__jschuetze_memberranks AS memberrank ON (memberrank.fk_mitglied = member.id)');
        $query->join('','#__jschuetze_titel       AS rank       ON (memberrank.fk_funktion = rank.id)');
        $query->join('LEFT', '#__jschuetze_titel  AS function   ON (member.fk_funktion     = function.id)');
        $query->join('LEFT', '#__jschuetze_status AS state      ON (member.fk_status       = state.id)');
        $query->where('member.published        = 1');
        $query->where('memberrank.funktion_bis = 0');
        $query->order('member.ordering');

        $db->setQuery( $query ); 
        $rows = $db->loadObjectList(); 

        return $rows; 
    } 

    function getLebenspartner($partnerid) 
    { 
        $db = JFactory::getDBO(); 
        $query = $db->getQuery(true);

        $query->select('*');
        $query->from('#__jschuetze_mitglieder');
        $query->where('id = '.(int)$partnerid);

        $db->setQuery( $query ); 
        $row = $db->loadObject(); 

        return $row; 
    } 
    
    function getZugkoenigschronik($memberid) 
    { 
        $db = JFactory::getDBO(); 
        $query = $db->getQuery(true);

        $query->select('aus.periode AS periode, art.name AS auszeichnung');
        $query->from('#__jschuetze_mitgliedsausz      AS aus ');
        $query->join('', '#__jschuetze_auszeichnungen AS art ON (aus.fk_auszeichnung = art.id)');
        $query->where('aus.fk_mitglied  = '.(int)$memberid);
        $query->where('(art.zugkoenig=1 OR art.corpskoenig=1 OR art.bruderkoenig=1)');
        $query->order('aus.auszeichnungsdatum DESC');

        $db->setQuery( $query ); 
        $rows = $db->loadObjectList(); 

        return $rows; 
    }     
    
    function getMemberfiles() 
    { 
        $members =& $this->getMembersForMemberfile();
        $user    =& JFactory::getUser(); 
        
        foreach ($members as $i => $member):
            $koenigschronik =& $this->getZugkoenigschronik($member->id); 
            
            $cont ='{tabs type=tabs}';
            $cont.='{tab title=<b>'. $member->vorname.' '.$member->name.'</b>}';
            $cont.='<div class="logoimage"><img src="components/com_jschuetze/assets/images/tzk_logo.png"></div><img class="memberimage" src="'.$member->foto_url.'">';
            $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_NAME')      .': <div class="myContent">'.$member->vorname.' '.$member->name.'</div></div><br /><br />';
            $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_RANK')      .': <div class="myContent">'.$member->rang.'</div></div><br />';
            $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_RANK_SINCE').': <div class="myContent">'.date('m.Y', strtotime($member->funktion_seit)).'</div></div><br />';
            if (!empty($member->funktion)){
                $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_FUNCTION')  .': <div class="myContent">'.$member->funktion.'</div></div><br />';
            }
            $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_BEITRITT')  .': <div class="myContent">'.date('m.Y', strtotime($member->beitritt)).'</div></div><br />';
            $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_BEITRITT_BRUDER').': <div class="myContent">'.date('m.Y', strtotime($member->beitritt_bruder)).'</div></div><br />';
            $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_STATUS')   .': <div class="myContent">'.$member->status.'</div></div><br /><br />';
            $cont.='{/tab}<br />';
            if (!empty($koenigschronik)){
                $cont.='{tab title='.JText::_('COM_JSCHUETZE_KOENIGSCHRONIK').'}';
                $cont.='<div class="logoimage"><img src="components/com_jschuetze/assets/images/tzk_logo.png"></div><img class="memberimage" src="'.$member->foto_url.'">';
                foreach($koenigschronik as $k => $koenig):
                    $cont.='<div class="label">'.$koenig->periode.': <div class="myContent">'.$koenig->auszeichnung.'</div></div><br />';
                endforeach;
                $cont.='{/tab}<br />';  
            }
            if (!$user->guest){
                $cont.='{tab title='.JText::_('COM_JSCHUETZE_ADRESS').'}';
                $cont.='<div class="logoimage"><img src="components/com_jschuetze/assets/images/tzk_logo.png"></div><img class="memberimage" src="'.$member->foto_url.'">';
                $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_NAME')  .': <div class="myContent">'.$member->vorname.' '.$member->name.'</div></div><br /><br />';
                $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_STREET').': <div class="myContent">'.$member->strasse.'</div></div><br />';
                $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_TOWN')  .': <div class="myContent">'.$member->plz.' '.$member->ort.'</div></div><br />';
                $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_PHONE') .': <div class="myContent">'.$member->tel.'</div></div><br />';
                $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_MOBILE').': <div class="myContent">'.$member->mobile.'</div></div><br />';
                $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_EMAIL') .': <div class="myContent">'.$member->email_priv.'</div></div><br />';
                $cont.='{/tab}<br />';
                if ($member->fk_lebenspartner != 0){
                    $partner = $this->getLebenspartner($member->fk_lebenspartner);
                    $cont.='{tab title='.JText::_('COM_JSCHUETZE_LEBENSPARTNER').'}';
                    $cont.='<img class="memberimage" src="'.$partner->foto_url.'">';
                    $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_NAME')  .': <div class="myContent">'.$partner->vorname.' '.$partner->name.'</div></div><br /><br />';
                    $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_STREET').': <div class="myContent">'.$partner->strasse.'</div></div><br />';
                    $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_TOWN')  .': <div class="myContent">'.$partner->plz.' '.$partner->ort.'</div></div><br />';
                    $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_PHONE') .': <div class="myContent">'.$partner->tel.'</div></div><br />';
                    $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_MOBILE').': <div class="myContent">'.$partner->mobile.'</div></div><br />';
                    $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_EMAIL') .': <div class="myContent">'.$partner->email_priv.'</div></div><br />';
                    $cont.='{/tab}<br />';
                }
            }
            $cont.='{/tabs}<br><br>';
            $content.=$cont;
        endforeach; 

        return $content; 
    }

} 
?>