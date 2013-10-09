<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/models/memberfiles.php                           //
// @implements  : Class jSchuetzeModelMemberfiles                       //
// @description : Model for the DB-Manipulation of the jSchuetze        //
// Version      : 1.0.2                                                 //
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
        $query->group('member.name, member.vorname, member.strasse');
        $query->order('member.ordering');

        $db->setQuery( $query ); 
        $rows = $db->loadObjectList(); 

        return $rows; 
    } 

    function getMemberVita($memberId)
    {
        $db = JFactory::getDBO(); 
        $query = $db->getQuery(true);

        $query->select('rank.name, memberrank.funktion_seit, memberrank.funktion_bis');
        $query->from('#__jschuetze_memberranks AS memberrank');
        $query->join('', '#__jschuetze_titel AS rank ON (memberrank.fk_funktion = rank.id)');
        $query->where('memberrank.fk_mitglied = '.(int)$memberId );
        $query->order('memberrank.funktion_seit DESC');
        
        $db->setQuery( $query ); 
        $rows = $db->loadObjectList(); 

        return $rows; 
    }
    
    function getCurrentAward($memberId)
    {
        $db = JFactory::getDBO(); 
        $query = $db->getQuery(true);

        $query->select('fk_mitglied, name, auszeichnungsdatum, periode, icon');
        $query->from('#__jschuetze_mitgliedsausz  as memberaward');
        $query->join('', '#__jschuetze_auszeichnungen as award on (memberaward.fk_auszeichnung = award.id)');
        //$query->where('(zugkoenig = 1 or pfand = 1)');
        $query->where('award.published = 1');
        $query->where('fk_mitglied='.(int)$memberId);
        $query->where('auszeichnungsdatum = (select MAX(auszeichnungsdatum) from #__jschuetze_mitgliedsausz as temp where temp.fk_auszeichnung = memberaward.fk_auszeichnung)');

        $db->setQuery( $query ); 
        $row = $db->loadObject(); 

        return $row; 
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
    
    function getGermanLongDate($aDate)
    {
        $monate=array("01"=>"Januar", "02"=>"Februar", "03"=>"März",      "04"=>"April",   "05"=>"Mai",      "06"=>"Juni", 
                      "07"=>"Juli",   "08"=>"August",  "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Dezember");
              
        return $monate[date('m', $aDate)].' '.date('Y', $aDate);
    }
    
    
    function getMemberfiles($params) 
    { 
        $members =& $this->getMembersForMemberfile();
        $user    =& JFactory::getUser(); 
        
        
        if ($params->get('tab_plugin') == 1){
            // Content Tabs & Silders von www.tooljoom.com
            $tabsTag='{tabs type=tabs}';
            $tabTag='{tab title=%s}';
            $tabEndtag='{/tab}<br />';
            $tabsEndtag='{/tabs}<br /><br />';
        } else {
            // Joomlaworks Tabs & Sliders; Funktioniert nicht richtig, weil die Content Felder zu klein sind
            // Workaround: in der /site/assets/css/memberfiles.css die Klasse .jwts_tabbertab eingetragen.
            //             dort kann kann man die gewünschte Höhe für die Tabs einstellen. 
            $tabsTag='';
            $tabTag='{tab=%s}';
            $tabEndtag='<br />';
            $tabsEndtag='{/tabs}<br /><br />';
        }
        
        $zugLogo = $params->get('logoimage');  //'components/com_jschuetze/assets/images/tzk_logo.png';
        $noImage = $params->get('noimage');    //'images/stories/TzK_Mitglieder/kein_bild.png';

        foreach ($members as $i => $member):
            $koenigschronik =& $this->getZugkoenigschronik($member->id); 
            $vitae          =& $this->getMemberVita($member->id); 
            $currentAward   =& $this->getCurrentAward($member->id);
            if ($member->foto_url == '') {
                $member->foto_url = $noImage;
            }

            if (!empty($currentAward)) {
                $memberImage = '<div class="logoblock"><img class="logoimage" src="'.$zugLogo.'" alt="'.JText::_('COM_JSCHUETZE_ALT_LOGO').'"><br /><img class="pfandimage" src="'
                                .$currentAward->icon.'" title="'.$currentAward->name.' - '.$currentAward->periode.'" alt="'.$currentAward->name.
                                '"></div><img class="memberimage" src="'.$member->foto_url.'" alt="'.sprintf(JText::_('COM_JSCHUETZE_ALT_USERIMAGE'), $member->vorname.' '.$member->name).'">';
            } else {
                $memberImage = '<div class="logoblock"><img  class="logoimage"src="'.$zugLogo.'" alt="'.JText::_('COM_JSCHUETZE_ALT_LOGO')
                                .'"></div><img class="memberimage" src="'.$member->foto_url.'" alt="'
                                .sprintf(JText::_('COM_JSCHUETZE_ALT_USERIMAGE'), $member->vorname.' '.$member->name).'">';
            }

//.'<div class="pagecontent">'            
            
            $cont = $tabsTag;
            // Tab: Mitgliedsinformationen
            $cont.= sprintf($tabTag, $member->vorname.' '.$member->name);
            $cont.=$memberImage;
            $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_NAME')      .': <div class="myContent">'.$member->vorname.' '.$member->name.'</div></div><br /><br />';
            $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_RANK')      .': <div class="myContent">'.$member->rang.'</div></div><br />';
            $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_RANK_SINCE').': <div class="myContent">'.$this->getGermanLongDate(strtotime($member->funktion_seit)).'</div></div><br />';
            if (!empty($member->funktion)){
                $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_FUNCTION')  .': <div class="myContent">'.$member->funktion.'</div></div><br />';
            }
            $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_BEITRITT')  .': <div class="myContent">'.$this->getGermanLongDate(strtotime($member->beitritt)).'</div></div><br />';
            $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_BEITRITT_BRUDER').': <div class="myContent">'.$this->getGermanLongDate(strtotime($member->beitritt_bruder)).'</div></div><br />';
            $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_STATUS')   .': <div class="myContent">'.$member->status.'</div></div><br /><br />';
            $cont.=$tabEndtag;
            if (!empty($koenigschronik)){
                // Tab: Königschronik
                $cont.=sprintf($tabTag, JText::_('COM_JSCHUETZE_KOENIGSCHRONIK'));
                $cont.=$memberImage;
                foreach($koenigschronik as $k => $koenig):
                    $cont.='<div class="label">'.$koenig->periode.': <div class="myContent">'.$koenig->auszeichnung.'</div></div><br />';
                endforeach;
                $cont.=$tabEndtag;
            }
            // Tab: Schützen-Vita
            $cont.=sprintf($tabTag, JText::_('COM_JSCHUETZE_VITA'));
            $cont.=$memberImage;
            foreach($vitae as $k => $vita):
                if ($vita->funktion_bis==0) {
                        $enddate = JText::_('COM_JSCHUETZE_TODAY');
                    } else {
                        $enddate = $this->getGermanLongDate(strtotime($vita->funktion_bis));
                    };
                $cont.='<div class="label">'.$vita->name.': <div class="myContent">'.$this->getGermanLongDate(strtotime($vita->funktion_seit)).' '.JText::_('COM_JSCHUETZE_UNTIL').' '. $enddate.'</div></div><br />';
            endforeach;
            $cont.=$tabEndtag;
            if (!$user->guest){
                // Tab: Adresse
                $cont.=sprintf($tabTag, JText::_('COM_JSCHUETZE_ADRESS'));
                $cont.=$memberImage;
                $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_NAME')  .': <div class="myContent">'.$member->vorname.' '.$member->name.'</div></div><br /><br />';
                $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_STREET').': <div class="myContent">'.$member->strasse.'</div></div><br />';
                $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_TOWN')  .': <div class="myContent">'.$member->plz.' '.$member->ort.'</div></div><br />';
                $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_PHONE') .': <div class="myContent">'.$member->tel.'</div></div><br />';
                $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_MOBILE').': <div class="myContent">'.$member->mobile.'</div></div><br />';
                $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_EMAIL') .': <div class="myContent">'.$member->email_priv.'</div></div><br />';
                $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_BIRTHDAY') .': <div class="myContent">'.date('d.m.Y', strtotime($member->geburtstag)).'</div></div><br />';
                $cont.=$tabEndtag;
                if ($member->fk_lebenspartner != 0){
                    // Tab: Lebenspartner
                    $partner = $this->getLebenspartner($member->fk_lebenspartner);
                    if ($partner->foto_url == '') { $partner->foto_url = $noImage; }
                    $memberImage = '<div class="logoblock"><img class="logoimage" src="'.$zugLogo.'" alt="'.JText::_('COM_JSCHUETZE_ALT_LOGO').'"><br /></div><img class="memberimage" src="'
                                   .$partner->foto_url.'" alt="'.sprintf(JText::_('COM_JSCHUETZE_ALT_USERIMAGE'), $partner->vorname.' '.$partner->name).'">';
                    $cont.=sprintf($tabTag, JText::_('COM_JSCHUETZE_LEBENSPARTNER'));
                    $cont.=$memberImage;
                    $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_NAME')  .': <div class="myContent">'.$partner->vorname.' '.$partner->name.'</div></div><br /><br />';
                    $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_STREET').': <div class="myContent">'.$partner->strasse.'</div></div><br />';
                    $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_TOWN')  .': <div class="myContent">'.$partner->plz.' '.$partner->ort.'</div></div><br />';
                    $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_PHONE') .': <div class="myContent">'.$partner->tel.'</div></div><br />';
                    $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_MOBILE').': <div class="myContent">'.$partner->mobile.'</div></div><br />';
                    $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_EMAIL') .': <div class="myContent">'.$partner->email_priv.'</div></div><br />';
                    $cont.='<div class="label">'.JText::_('COM_JSCHUETZE_BIRTHDAY') .': <div class="myContent">'.date('d.m.Y', strtotime($partner->geburtstag)).'</div></div><br />';
                    $cont.=$tabEndtag;
                }
            }
            $cont.=$tabsEndtag;
            $content.=$cont;
        endforeach; 

        return $content; 
    }

} 
?>