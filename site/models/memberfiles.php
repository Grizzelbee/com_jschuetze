 <?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/models/memberfiles.php                           //
// @implements  : Class jSchuetzeModelMemberfiles                       //
// @description : Model for the DB-Manipulation of the jSchuetze        //
// Version      : 1.1.5                                                 //
// Change-Id: I0000000000000000000000000000000000000000                 //
// Signed-off-by: Hanjo Hingsen <hanjo@hingsen.de>                      //
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
        // Neue Query: Sollen die Königstitel in die Vita, oder nicht? Vielleicht als Option einbauen
        
        $query = 'SELECT rank.name, memberrank.funktion_seit, memberrank.funktion_bis, 0 AS award '
                .'FROM   #__jschuetze_memberranks AS memberrank '
                .'JOIN   #__jschuetze_titel       AS rank ON (memberrank.fk_funktion = rank.id) '
                .'WHERE  memberrank.fk_mitglied ='.$memberId.' '
                .'UNION '
                .'SELECT award.name, memberaward.auszeichnungsdatum, NULL as funktion_bis, 1 AS award '  
                .'FROM   #__jschuetze_mitgliedsausz  AS memberaward '
                .'JOIN   #__jschuetze_auszeichnungen AS award ON (memberaward.fk_auszeichnung = award.id) '
                .'WHERE  memberaward.fk_mitglied ='.$memberId.' '
                .'and    award.pfand       = 0 ' 
                .'and    award.koenig      = 0 '
                .'and    award.published   = 1 '
                .'order by funktion_seit DESC;';
       
        $db->setQuery( $query ); 
        $rows = $db->loadObjectList(); 

        return $rows; 
    }
    
    function getCurrentAwards($memberId)
    {
        $db = JFactory::getDBO(); 
        $query = $db->getQuery(true);

        $query->select('fk_mitglied, name, auszeichnungsdatum, periode, icon');
        $query->from('#__jschuetze_mitgliedsausz  as memberaward');
        $query->join('', '#__jschuetze_auszeichnungen as award on (memberaward.fk_auszeichnung = award.id)');
        $query->where('award.memberfiles = 1');
        $query->where('award.published   = 1');
        $query->where('fk_mitglied='.(int)$memberId);
        $query->where('auszeichnungsdatum = (select MAX(auszeichnungsdatum) from #__jschuetze_mitgliedsausz as temp where temp.fk_auszeichnung = memberaward.fk_auszeichnung)');
        $query->order('pfand desc');
        $db->setQuery( $query ); 
        $row = $db->loadObjectList(); 

        return $row; 
    }
    
    function getMemberData($memberId, $params) 
    { 
        $db = JFactory::getDBO(); 
        $query = $db->getQuery(true);

        $query->select('*');
        $query->from('#__jschuetze_mitglieder');
        $query->where('id = '.(int)$memberId);

        $db->setQuery( $query ); 
        $row = $db->loadObject(); 

        if ($row->foto_url == '') { 
            $row->foto_url = $params->get('noimage'); 
        }        
        
        return $row; 
    } 
    
    function getZugkoenigschronik($memberid) 
    { 
        $db    = JFactory::getDBO(); 
        $query = $db->getQuery(true);

        $query->select('aus.periode AS periode, art.name AS auszeichnung');
        $query->from('#__jschuetze_mitgliedsausz      AS aus ');
        $query->join('', '#__jschuetze_auszeichnungen AS art ON (aus.fk_auszeichnung = art.id)');
        $query->where('aus.fk_mitglied  = '.(int)$memberid);
        $query->where('art.koenig    = 1');
        $query->where('art.published = 1');
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


    function getMemberLendings($memberId) 
    { 
        $db = JFactory::getDBO(); 
        $query = $db->getQuery(true);

        $query->select('fundus.name AS item, (lending.anzahl_aus - lending.anzahl_rueck) AS anzahl, ausgabe');
        $query->from('#__jschuetze_lending   AS lending');
        $query->join('','#__jschuetze_fundus AS fundus ON (lending.fk_fundus = fundus.id)');
        $query->where('fundus.published        = 1');
        $query->where('lending.published       = 1');
        $query->where('lending.anzahl_aus - lending.anzahl_rueck != 0');
        $query->where('lending.fk_schuetze     = '.(int)$memberId);
        $query->order('ausgabe asc');
        $db->setQuery( $query ); 
        $rows = $db->loadObjectList(); 

        return $rows; 
    } 
    
    public function getVCard($user)
    {
        $vcard = "BEGIN:VCARD\r\nVERSION:3.0\r\n"
                ."N:". $user->name . ";" . $user->vorname . "\r\n"
                ."FN:" . $user->vorname . " " . $user->name . "\r\n"
                ."TEL;TYPE=voice:" . $user->tel . "\r\n"
                ."TEL;TYPE=cell:" . $user->mobile . "\r\n"
                ."ADR;TYPE=home:;;".$user->strasse.";".$user->ort.";;".$user->plz."\r\n"
                ."BDAY:".$user->geburtstag."\r\n"
                ."EMAIL;TYPE=internet,pref:".$user->email_priv."\r\n"
                ."END:VCARD";        

        return $vcard;
    }
    
    public function getVCardAsFile($user)
    {
        return $this->getVCard( $this->getMemberData($user) );
    }
    
    protected function getMemberPage($tabTag, $tabEndTag, $logoImage, $memberImage, $member)
    {
        // Tab: Mitgliedsinformationen
        $cont  = sprintf($tabTag, $member->vorname.' '.$member->name);
        $cont .= $logoImage;
        $cont .= '<div class="contentColumn">';
        $cont .= '<div class="label">'.JText::_('COM_JSCHUETZE_NAME')      .':<br />';
        $cont .= '<div class="inhalt">'.$member->vorname.' '.$member->name.'</div></div><br />';
        $cont .= '<div class="label">'.JText::_('COM_JSCHUETZE_RANK')      .':<br />';
        $cont .= '<div class="inhalt">'.$member->rang.'</div></div>';
        $cont .= '<div class="label">'.JText::_('COM_JSCHUETZE_RANK_SINCE').':<br />';
        $cont .= '<div class="inhalt">'.$this->getGermanLongDate(strtotime($member->funktion_seit)).'</div></div>';
        if (!empty($member->funktion)){
            $cont .= '<div class="label">'.JText::_('COM_JSCHUETZE_FUNCTION').':<br />';
            $cont .= '<div class="inhalt">'.$member->funktion.'</div></div>';
        }
        $cont .= '<div class="label">'.JText::_('COM_JSCHUETZE_BEITRITT').':<br />';
        $cont .= '<div class="inhalt">'.$this->getGermanLongDate(strtotime($member->beitritt)).'</div></div>';
        $cont .= '<div class="label">'.JText::_('COM_JSCHUETZE_BEITRITT_BRUDER').':<br />';
        $cont .= '<div class="inhalt">'.$this->getGermanLongDate(strtotime($member->beitritt_bruder)).'</div></div>';
        $cont .= '<div class="label">'.JText::_('COM_JSCHUETZE_STATUS').':<br />';
        $cont .= '<div class="inhalt">'.$member->status.'</div></div>';
        $cont .= '</div>';
        $cont .= $memberImage;
        $cont .= $tabEndTag;    
        
        return $cont;
    }
    
    protected function getKingsPage($tabTag, $tabEndTag, $logoImage, $memberImage, $koenigschronik)
    {
        $cont  = sprintf($tabTag, JText::_('COM_JSCHUETZE_KOENIGSCHRONIK'));
        $cont .= $logoImage;
        $cont .= '<div class="contentColumn">';
        foreach($koenigschronik as $k => $koenig):
            $cont .= '<div class="label">'.$koenig->periode.':<br />';
            $cont .= '<div class="inhalt">'.$koenig->auszeichnung.'</div></div>';
        endforeach;
        $cont .= '</div>';
        $cont .= $memberImage;
        $cont .= $tabEndTag;

        return $cont;
    }

    protected function getVitaPage($tabTag, $tabEndTag, $logoImage, $memberImage, $vitae)
    {
        $cont  = sprintf($tabTag, JText::_('COM_JSCHUETZE_VITA'));
        $cont .= $logoImage;
        $cont .= '<div class="contentColumn">';
        foreach($vitae as $k => $vita):
            if ($vita->funktion_bis==0) {
                    $enddate = JText::_('COM_JSCHUETZE_TODAY');
                } else {
                    $enddate = $this->getGermanLongDate(strtotime($vita->funktion_bis));
                };
            $cont .= '<div class="label">'.$vita->name.':<br />';
            if ( $vita->award == 0) {
                $cont .= '<div class="inhalt">'.$this->getGermanLongDate(strtotime($vita->funktion_seit)).' '.JText::_('COM_JSCHUETZE_UNTIL').' '. $enddate.'</div></div>';
            } else {
                $cont .= '<div class="inhalt">'.$this->getGermanLongDate(strtotime($vita->funktion_seit)).'</div></div>';
            }
        endforeach;
        $cont .= '</div>';
        $cont .= $memberImage;
        $cont .= $tabEndTag;

        return $cont;
    }
    
    protected function getAdressPage($tabTag, $tabEndTag, $logoImage, $memberImage, $member, $user, $params, $tabLabel)
    {
        $cont  = sprintf($tabTag, JText::_($tabLabel));

        if ( (!$user->guest) or ($params->get('show_vcard_public') == 1 ) ) {
            $cont .= '<div class="logoblock"><img class="logoimage" src="'.$params->get('logoimage').'" alt="'.JText::_('COM_JSCHUETZE_ALT_LOGO').'"/><br />';
            if ($params->get('vcard_as_qrcode') == 1) {
                $VCFImage  = '<img class="pfandimage" src="http://chart.apis.google.com/chart?cht=qr&chs=150x150&chld=L|0&chl=' . urlencode($this->getVCard($member)) . '" alt="'.JText::_('COM_JSCHUETZE_BUSINESSCARD_QR').'" title="'.JText::_('COM_JSCHUETZE_BUSINESSCARD_QR_DESC').'" />';
            } else {
                $VCFImage  = '<img class="pfandimage" src="media/com_jschuetze/images/vcard_dl.png" alt="'.JText::_('COM_JSCHUETZE_BUSINESSCARD').'" title="'.JText::_('COM_JSCHUETZE_BUSINESSCARD_DESC').'" />';            
            }
            $cont .= '<a href="'.JRoute::_('index.php?option=com_jschuetze&task=memberfiles.getVCardAsFile&format=raw&filename='.$member->vorname.'_'.$member->name.'&userid='.$member->id).'">'.$VCFImage.'</a>'; 
            $cont .= '</div>';  
        } else {
            $cont .= $logoImage;
        }
        $cont .= '<div class="contentColumn">';
        $cont .= '<div class="label">'.JText::_('COM_JSCHUETZE_NAME')  .':<br /><div class="inhalt">'.$member->vorname.' '.$member->name.'</div></div><br />';
        $cont .= '<div class="label">'.JText::_('COM_JSCHUETZE_STREET').':<br /><div class="inhalt">'.$member->strasse.'</div></div>';
        $cont .= '<div class="label">'.JText::_('COM_JSCHUETZE_TOWN')  .':<br /><div class="inhalt">'.$member->plz.' '.$member->ort.'</div></div>';
        $cont .= '<div class="label">'.JText::_('COM_JSCHUETZE_PHONE') .':<br /><div class="inhalt">'.$member->tel.'</div></div>';
        $cont .= '<div class="label">'.JText::_('COM_JSCHUETZE_MOBILE').':<br /><div class="inhalt">'.$member->mobile.'</div></div>';
        $cont .= '<div class="label">'.JText::_('COM_JSCHUETZE_EMAIL') .':<br /><div class="inhalt">'.JHTML::_('email.cloak',$member->email_priv).'</div></div>';
        $cont .= '<div class="label">'.JText::_('COM_JSCHUETZE_BIRTHDAY') .':<br /><div class="inhalt">'.date('d.m.Y', strtotime($member->geburtstag)).'</div></div>';
        $cont .= '</div>';
        $cont .= $memberImage;
        $cont .= $tabEndTag;

        return $cont;
    }

    protected function getLendingsPage($tabTag, $tabEndTag, $logoImage, $memberImage, $member)
    {
        $lendings = $this->getMemberLendings($member->id);

        if (!empty($lendings)){
            $cont  = sprintf($tabTag, JText::_('COM_JSCHUETZE_LENDINGS'));
            $cont .= $logoImage;
            $cont .= '<div class="contentColumn">';
            foreach ($lendings as $l => $lending):
                $cont .= '<div class="label" style="text-align: justify">'.date('d.m.Y', strtotime($lending->ausgabe)).': '.$lending->anzahl.' '.$lending->item.'</div>';
            endforeach;
            $cont .= '</div>';
            $cont .= $memberImage;
            $cont .= $tabEndTag;
        }
        
        return $cont;
    }

    function getMemberfiles($params) 
    { 
        $members = $this->getMembersForMemberfile();
        $user    = JFactory::getUser(); 
        $content = '';
        
        switch ( $params->get('tab_plugin') )
        {
            case 0:
                // Joomlaworks Tabs & Sliders; Funktioniert nicht richtig, weil die Content Felder zu klein sind
                // Workaround: in der /site/assets/css/memberfiles.css die Klasse .jwts_tabbertab eingetragen.
                //             dort kann kann man die gewünschte Höhe für die Tabs einstellen. 
                $tabsTag='';
                $tabTag='{tab=%s}';
                $tabEndTag='<br />';
                $tabsEndtag='{/tabs}<br /><br />';
            break;
            case 1:
                // Content Tabs & Silders von www.tooljoom.com
                $tabsTag='{tabs type=tabs}';
                $tabTag='{tab title=%s}';
                $tabEndTag='{/tab}<br />';
                $tabsEndtag='{/tabs}<br /><br />';
            break;
            case 2:
                // Core Design MagicTabs
                $tabsTag='{magictabs}';
                $tabTag='%s::';
                $tabEndTag='||||';
                $tabsEndtag='{/magictabs}<br /><br />';
            break;
            case 3:
                // NoNumber Tabs by NoNumber.nl
                $tabsTag='';
                $tabTag='{tab %s}';
                $tabEndTag='<br />';
                $tabsEndtag='{/tabs}<br /><br />';
            break;
            case 4:
                // Uygun Tabs by joomlabusiness.net
                // Fork von: Joomlaworks Tabs & Sliders;
                $tabsTag='';
                $tabTag='{tab=%s}';
                $tabEndTag='<br />';
                $tabsEndtag='{/tabs}<br /><br />';
            break;
        }
                
        $zugLogo = $params->get('logoimage');  //'components/com_jschuetze/assets/images/tzk_logo.png';
        $noImage = $params->get('noimage');    //'images/stories/TzK_Mitglieder/kein_bild.png';

        foreach ($members as $i => $member):
            $koenigschronik = $this->getZugkoenigschronik($member->id); 
            $vitae          = $this->getMemberVita($member->id); 
            $currentAwards  = $this->getCurrentAwards($member->id);
            if ( $member->foto_url == ''){
                $member->foto_url =& $noImage;
            }
            
            if (!empty($currentAwards)) {
				$imageOffset=0;
				$logoImage = '<div class="logoblock"><img class="logoimage" src="'.$zugLogo.'" alt="'.JText::_('COM_JSCHUETZE_ALT_LOGO').'"><br />';
				foreach ($currentAwards as $a => $award){
					$logoImage .= '<img class="pfandimage" style="padding-left:'.$imageOffset.'em;" src="'.$award->icon.'" title="'.$award->name.' - '.$award->periode.'" alt="'.$award->name.'">';
					$imageOffset += 30;	          
				}   
				$logoImage .= '</div>';                     
			} else {
				$logoImage = '<div class="logoblock"><img  class="logoimage" src="'.$zugLogo.'" alt="'.JText::_('COM_JSCHUETZE_ALT_LOGO')
							.'"></div>';
			}
	
			$memberImage = '<img class="memberimage" src="'.$member->foto_url.'" alt="'.sprintf(JText::_('COM_JSCHUETZE_ALT_USERIMAGE'), $member->vorname.' '.$member->name).'">';
           
            $cont  = $tabsTag;
            // Mitgliederseite einfügen
            if ($params->get('show_page_main') == 1){
            	$cont .= $this->getMemberPage($tabTag, $tabEndTag, $logoImage, $memberImage, $member);
            }
            // Tab: Schützen-Vita
            if ($params->get('show_page_vita') == 1){
            	$cont .= $this->getVitaPage($tabTag, $tabEndTag, $logoImage, $memberImage, $vitae);
            }
            // Tab: Königschronik
            if ( ($params->get('show_page_kingchronicles') == 1) and (!empty($koenigschronik)) ){
                $cont .= $this->getKingsPage($tabTag, $tabEndTag, $logoImage, $memberImage, $koenigschronik);
            }
            // Tab: Adresse
            if ($params->get('show_page_address') == 1){
            	if ( (!$user->guest) or ($params->get('show_adress_public') == 1) ){
                	$cont .= $this->getAdressPage($tabTag, $tabEndTag, $logoImage, $memberImage, $member, $user, $params, 'COM_JSCHUETZE_ADRESS');
            	}                	
            }
            // Seiten, die nur für angemeldete Benutzer sind
            if (!$user->guest){
                // tab: Lendings
            	if ($params->get('show_page_lendings') == 1){
            		$cont .= $this->getLendingsPage($tabTag, $tabEndTag, $logoImage, $memberImage, $member);
            	}	        
                // Tab: Lebenspartner
                if ( ($params->get('show_page_partner') == 1) and ($member->fk_lebenspartner != 0) ){
                    $partner = $this->getMemberData($member->fk_lebenspartner, $params);
                    $memberImage = '<img class="memberimage" src="'.$partner->foto_url.'" alt="'.sprintf(JText::_('COM_JSCHUETZE_ALT_USERIMAGE'), $partner->vorname.' '.$partner->name).'">';
                    $cont .= $this->getAdressPage($tabTag, $tabEndTag, $logoImage, $memberImage, $partner, $user, $params, 'COM_JSCHUETZE_LEBENSPARTNER');
                }
            }
            $cont    .= $tabsEndtag;
            $content .= $cont;
        endforeach; 
        
        return $content; 
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