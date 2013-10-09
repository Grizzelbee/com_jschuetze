<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/models/adressliste.php                           //
// @implements  : Class jSchuetzeModelAdressliste                       //
// @description : Model for the DB-Manipulation of jSchuetze            //
// Version      : 1.1.0                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted Access' ); 
// Include dependancy of the main model
jimport('joomla.application.component.model');
jimport( 'joomla.filesystem.file' );
jimport( 'joomla.environment.response' );

class jSchuetzeModelAdressliste extends JModelLegacy 
{ 
    private $__adressliste;
    private $__brotherhoodliste;
    
    function getAdressData() 
    { 
        $db = JFactory::getDBO(); 
        $query = $db->getQuery(true);

        $query->select('man.name as man_name, man.vorname as man_vorname, man.strasse as man_strasse, man.plz as man_plz, man.ort as man_ort, man.tel as man_tel, man.mobile as man_mobile, man.email_priv as man_email,
        woman.name as woman_name, woman.vorname as woman_vorname, woman.strasse as woman_strasse, woman.plz as woman_plz, woman.ort as woman_ort, woman.tel as woman_tel, woman.mobile as woman_mobile, woman.email_priv as woman_email');
        $query->from('#__jschuetze_mitglieder AS man');
        $query->join('LEFT', '#__jschuetze_mitglieder AS woman ON (man.fk_lebenspartner = woman.id)');
        $query->where('man.published = 1');
        $query->order('man.name, man.geburtstag');

        $db->setQuery( $query ); 
        $rows = $db->loadObjectList(); 

        return $rows; 
    } 

    function getBrotherhoodData() 
    { 
        $db = JFactory::getDBO(); 
        $query = $db->getQuery(true);

        $query->select('member.*, status.name AS status, rank.name AS rang');
        $query->from('#__jschuetze_mitglieder      AS member');
        $query->join('', '#__jschuetze_status      AS status ON (member.fk_status   = status.id)');
        $query->join('', '#__jschuetze_memberranks AS ranks  ON (ranks.fk_mitglied = member.id)');
        $query->join('', '#__jschuetze_titel       AS rank   ON (ranks.fk_funktion = rank.id)');
        $query->where('member.published = 1');
        $query->where('rank.rank = 1');
        $query->where('ranks.funktion_seit <= current_date');
        $query->where('ranks.funktion_bis = 0');
        $query->order('member.mitgliedsnr_bruder');

        $db->setQuery( $query ); 
        $rows = $db->loadObjectList(); 

        return $rows; 
    } 

    function getAdressListe($pdf_headline, $pdf_subtitle, $forPDF = false ) 
    { 
        if (!empty($__adressliste)) {
            $result = $__adressliste;
        } else {
            $items = $this->getAdressData();
            $result = '';
            if ($forPDF) {
                $result .= '<h2>'.$pdf_headline.'</h2><p>'.$pdf_subtitle.'</p><table style="width:100%; border=1px; border-style:solid; border-color:grey; border-spacing:0px;"><thead style="color:white; background-color:grey;">';
            } else {
                $result .= '<table class="adresstable"><thead>';
            }
            $result .= '<tr>';
            // Tablehead aufbauen
                $result .= '<th>' . JText::_('COM_JSCHUETZE_NAME').'</th>';
                $result .= '<th>' . JText::_('COM_JSCHUETZE_VORNAME').'</th>';
                $result .= '<th>' . JText::_('COM_JSCHUETZE_STREET').'</th>';
                $result .= '<th style="width:10%">' . JText::_('COM_JSCHUETZE_TOWN').'</th>';
                $result .= '<th>' . JText::_('COM_JSCHUETZE_PHONE').'</th>';
                $result .= '<th>' . JText::_('COM_JSCHUETZE_MOBILE').'</th>';
                if ($forPDF) {
                    $result .= '<th>' . JText::_('COM_JSCHUETZE_EMAIL').'</th>';
                }
            $result .= '</tr></thead><tbody>';

            foreach ($items as $i => $item):
                // Table rows einfügen
                $result .= '<tr><td>'.$item->man_name.'</td>';
                $result .= '<td>'.$item->man_vorname.'</td>';
                $result .= '<td>'.$item->man_strasse.'</td>';
                $result .= '<td>'.$item->man_plz.' '.$item->man_ort.'</td>';
                $result .= '<td>'.$item->man_tel.'</td>';
                $result .= '<td>'.$item->man_mobile.'</td>';
                if ($forPDF) {
                    $result .= '<td>'.$item->man_email.'</td>';
                }
                $result .= '</tr>';
                $result .= '<tr><td>'.$item->woman_name.'</td>';
                $result .= '<td>'.$item->woman_vorname.'</td>';
                $result .= '<td>'.$item->woman_strasse.'</td>';
                $result .= '<td>'.$item->woman_plz.' '.$item->woman_ort.'</td>';
                $result .= '<td>'.$item->woman_tel.'</td>';
                $result .= '<td>'.$item->woman_mobile.'</td>';
                if ($forPDF) {
                    $result .= '<td>'.$item->woman_email.'</td>';
                }
                $result .= '</tr>';
                $result .= '<tr class="divider" style="background-color:grey;>"><td colspan="7"></td></tr>';
            endforeach;
            $result .= '</tbody></table><br />';
            
            $__adressliste = $result;
        }
        
        return $result;
    }

    public function getFormatedDate($aDate){
        if ($aDate == 0) {
            $result = '---';
        } else {
            $result = date ('d.m.Y', strToTime($aDate));
        }

        return $result;
    }
    
    
    function getBrotherhoodListe($pdf_headline, $pdf_subtitle, $forPDF = false ) 
    { 
        if (!empty($__brotherhoodliste)) {
            $result = $__brotherhoodliste;
        } else {
            $items = $this->getBrotherhoodData();
            $result = '';
            if ($forPDF) {
                $thead = '<h2>'.$pdf_headline.'</h2><p>'.$pdf_subtitle.'</p><table style="width:100%; border=1px; border-style:solid; border-color:grey; border-spacing:0px;"><tbody>';
                $tfoot = "</tbody></table><p>Seite: %d</p><p  style=\"page-break-after:always;\"> Stand: ".date('d.m.Y', time());
            } else {
                $thead = '<table class="adresstable"><tbody>';
                $tfoot = '</tbody></table>';
            }
            
            $n    = 1;
            $page = 1;
            $result .= $thead;
            foreach ($items as $i => $item):
                // Table rows einfügen
                $result .= '<tr><td><b>'.JText::_('COM_JSCHUETZE_MITGLIEDSNR_BRUDERSCHAFT').'</b></td><td><b>'.$item->mitgliedsnr_bruder.'</b></td><td></td><td></td></tr>';
                $result .= '<tr><td><b>'.JText::_('COM_JSCHUETZE_NAME').'</b></td><td>'.$item->name.'</td><td><b>'.JText::_('COM_JSCHUETZE_RELIGION').'</b></td><td>'.$item->religion.'</td></tr>';
                $result .= '<tr><td><b>'.JText::_('COM_JSCHUETZE_VORNAME').'</b></td><td>'.$item->vorname.'</td><td><b>'.JText::_('COM_JSCHUETZE_BIRTHDAY').'</b></td><td>'.$this->getFormatedDate($item->geburtstag).'</td></tr>';
                $result .= '<tr><td><b>'.JText::_('COM_JSCHUETZE_STREET').'</b></td><td>'.$item->strasse.'</td><td><b>'.JText::_('COM_JSCHUETZE_BEITRITT').'</b></td><td>'.$this->getFormatedDate($item->beitritt).'</td></tr>';
                $result .= '<tr><td><b>'.JText::_('COM_JSCHUETZE_TOWN').'</b></td><td>'.$item->plz.' '.$item->ort.'</td><td><b>'.JText::_('COM_JSCHUETZE_BEITRITT_BRUDER').'</b></td><td>'.$this->getFormatedDate($item->beitritt_bruder).'</td></tr>';
                $result .= '<tr><td><b>'.JText::_('COM_JSCHUETZE_PHONE').'</b></td><td>'.$item->tel.'</td><td><b>'.JText::_('COM_JSCHUETZE_RANK').'</b></td><td>'.$item->rang.'</td></tr>';
                $result .= '<tr><td><b>'.JText::_('COM_JSCHUETZE_MOBILE').'</b></td><td>'.$item->mobile.'</td><td><b>'.JText::_('COM_JSCHUETZE_STATUS').'</b></td></td><td>'.$item->status.'</td></tr>';
                $result .= '<tr><td><b>'.JText::_('COM_JSCHUETZE_EMAIL').'</b></td><td>'.$item->email_priv.'</td><td></td><td></td></tr>';
                $result .= '<tr style="background-color:grey;>"><td colspan="4"></td></tr>';
                if ( (($n % 4) == 0 ) and $forPDF) {
                    $result .= sprintf($tfoot, $page).$thead; 
                    $page++;
                }
                $n++;
            endforeach;
            $result .= sprintf($tfoot, $page); 
            
            $__brotherhoodliste = $result;
        }
        
        return $result;
    }

    
    public function sendTextFile($filename, $content)
    {
        JResponse::setHeader('Content-Type', 'text/plain');
        JResponse::setHeader('Content-Transfer-Encoding', 'Binary');
        JResponse::setHeader('Content-Disposition', 'attachment; filename='.$filename.'.csv');
        JResponse::setHeader('Content-Length', strlen($content) );

        echo $content;
    }
    
    
    public function getAdressCSV($filename)
    {
        $items = $this->getAdressData();
        
        $CSV  = JText::_('COM_JSCHUETZE_NAME').';';
        $CSV .= JText::_('COM_JSCHUETZE_VORNAME').';';
        $CSV .= JText::_('COM_JSCHUETZE_STREET').';';
        $CSV .= JText::_('COM_JSCHUETZE_TOWN').';';
        $CSV .= JText::_('COM_JSCHUETZE_PHONE').';';
        $CSV .= JText::_('COM_JSCHUETZE_MOBILE').';';
        $CSV .= JText::_('COM_JSCHUETZE_EMAIL');    
        $CSV .= "\r\n";
        
        foreach ($items as $i => $item):
            // Table rows einfügen
            $CSV .= $item->man_name.';';
            $CSV .= $item->man_vorname.';';
            $CSV .= $item->man_strasse.';';
            $CSV .= $item->man_plz.';';
            $CSV .= $item->man_ort.';';
            $CSV .= $item->man_tel.';';
            $CSV .= $item->man_email;
            $CSV .= "\r\n";
            if (!empty($item->woman_name)) {
                $CSV .= $item->woman_name.';';
                $CSV .= $item->woman_vorname.';';
                $CSV .= $item->woman_strasse.';';
                $CSV .= $item->woman_plz.';';
                $CSV .= $item->woman_ort.';';
                $CSV .= $item->woman_tel.';';
                $CSV .= $item->woman_email;
                $CSV .= "\r\n";
            }
        endforeach;

        $this->sendTextFile($filename, $CSV);
    }    
    
    function getBrotherhoodCSV($filename) 
    { 
        $items = $this->getBrotherhoodData();
        
        $result = '';
        // CSV-headline aufbauen
        $result .= JText::_('COM_JSCHUETZE_MITGLIEDSNR_BRUDERSCHAFT').';';
        $result .= JText::_('COM_JSCHUETZE_RANK').';';
        $result .= JText::_('COM_JSCHUETZE_STATUS').';';
        $result .= JText::_('COM_JSCHUETZE_NAME').';';
        $result .= JText::_('COM_JSCHUETZE_VORNAME').';';
        $result .= JText::_('COM_JSCHUETZE_STREET').';';
        $result .= JText::_('COM_JSCHUETZE_PLZ').';';
        $result .= JText::_('COM_JSCHUETZE_ORT').';';
        $result .= JText::_('COM_JSCHUETZE_PHONE').';';
        $result .= JText::_('COM_JSCHUETZE_MOBILE').';';
        $result .= JText::_('COM_JSCHUETZE_EMAIL').';';
        $result .= JText::_('COM_JSCHUETZE_BIRTHDAY').';';
        $result .= JText::_('COM_JSCHUETZE_RELIGION').';';
        $result .= JText::_('COM_JSCHUETZE_BEITRITT').';';
        $result .= JText::_('COM_JSCHUETZE_BEITRITT_BRUDER').';';
        $result .= "\r\n";
        
        foreach ($items as $i => $item):
            // Table rows einfügen
            $result .= $item->mitgliedsnr_bruder.';';
            $result .= $item->rang.';';
            $result .= $item->status.';';
            $result .= $item->name.';';
            $result .= $item->vorname.';';
            $result .= $item->strasse.';';
            $result .= $item->plz.';';
            $result .= $item->ort.';';
            $result .= $item->tel.';';
            $result .= $item->mobile.';';
            $result .= $item->email_priv.';';
            $result .= $item->religion.';';
            $result .= $this->getFormatedDate($item->geburtstag).';';
            $result .= $this->getFormatedDate($item->beitritt).';';
            $result .= $this->getFormatedDate($item->beitritt_bruder);
            $result .= "\r\n";
        endforeach;
        
        $this->sendTextFile($filename, $result);
    } 
    
    public function getPDF($filename, $pdf_headline, $pdf_subtitle, $brotherhood=false)
    {
        require('components/com_jschuetze/assets/dompdf/dompdf_config.inc.php');

        $html  = '<head><meta http-equiv="content-type" content="text/html; charset=utf-8"></head><html><body>';  
        if ($brotherhood){
            $html .= $this->getBrotherhoodListe($pdf_headline, $pdf_subtitle, true);
        } else {
            $html .= $this->getAdressListe($pdf_headline, $pdf_subtitle, true);
        }
        $html .= '</body></html>';  
          
        $dompdf = new DOMPDF();
        if ($brotherhood){
            $dompdf->set_paper('A4', 'portrait');
        } else {
            $dompdf->set_paper('A4', 'landscape');
        }
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("$filename.pdf");
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