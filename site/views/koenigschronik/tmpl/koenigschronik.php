<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/views/koenigschronik/tmpl/koenigschronik.php     //
// @implements  :                                                       //
// @description : Entry-File for the jSchuetze-koenigschronik-View      //
// Version      : 1.0.4                                                 //
// *********************************************************************//
//Aufruf nur durch Joomla! zulassen
defined('_JEXEC')or die('Restricted access'); 
// get document to add scripts or StyleSheets
$document = JFactory::getDocument();
if ( $this->params->get('bildbefestigung') == 1) {
    $document->addStyleSheet($this->baseurl.'/components/com_jschuetze/assets/css/koenigschronik_taped.css');
} else {
    $document->addStyleSheet($this->baseurl.'/components/com_jschuetze/assets/css/koenigschronik_nailed.css');
}
$menu      = &JSite::getMenu();
$active    = $menu->getActive();
$menutitle = $active->title;
?> 
<div class="componentheading"><b><?php echo $menutitle; ?></b></div>
<div>
    <?php
    if ( $this->params->get('show_headerimage') == 1) 
    {
        if ( $this->params->get('headerimage_left_right') == 1){
            echo '<img style="float:right;" src="'.$this->params->get('headerimage').'" alt="" title=""/>';
        }else {
            echo '<img style="float:left;" src="'.$this->params->get('headerimage').'" alt="" title=""/>';
        }

    }
    if ( $this->params->get('show_page_heading') == 1) 
    {
        echo '<h1 style="vertical-align:middle;"><center>' . $this->params->get('page_heading') .'<center></h1><p />';
        echo '<div style="width:100%; text-align: justify; text-justify: newspaper">'. $this->params->get('preamble') . '</div>';
        echo '<p style="clear:both;"></p>';
    }    
    ?>
</div>
<div class="page_body"> 
    <div class="kingsgallery">
        <?php foreach ($this->kings as $n => $king): ?>
            <div class="fotoframe">
                <span class="saison"><?php echo $king->periode; ?></span>
                <img  src="<?php if (empty($king->foto_url)){ echo $this->params->get('noimage'); }else{ echo $king->foto_url; } ?>" title="" alt="" />
                <span class="bildbefestigung"></span>
                <span class="name"><?php echo JTEXT::_('COM_JSCHUETZE_MAJESTY').' '.$king->vorname.' '.$king->titel.' '.$king->name; ?></span>
            </div>
        <?php endforeach; ?>
    </div>
<p style="clear:both;"></p>
<br /><br />        
<center>jSchützenzug v<?php echo _JSCHUETZE_VERSION; ?></center>
<center>Copyright &copy; <?php echo date('Y', time() )?> by Hanjo Hingsen, Webmaster of  <a href="http://www.treu-zu-kaarst.de">http://www.treu-zu-kaarst.de</a>, All Rights reserved</center>
</div>