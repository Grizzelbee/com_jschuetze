<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/views/koenigschronik/tmpl/koenigschronik.php     //
// @implements  :                                                       //
// @description : Entry-File for the jSchuetze-koenigschronik-View      //
// Version      : 1.0.6                                                 //
// *********************************************************************//
//Aufruf nur durch Joomla! zulassen
defined('_JEXEC')or die('Restricted access'); 
// get document to add scripts or StyleSheets
$document = JFactory::getDocument();
// get the active MenuItem
$active    = $this->menu->getActive();
$menutitle = $active->title;
$this->model->setPagehit($menutitle);

switch($this->params->get('bildbefestigung'))
{
    case 1:
        $document->addStyleSheet($this->baseurl.'/components/com_jschuetze/assets/css/koenigschronik_taped.css');
        break;
    case 2:
        $document->addStyleSheet($this->baseurl.'/components/com_jschuetze/assets/css/koenigschronik_nailed.css');
        break;
    case 3:
        $document->addStyleSheet($this->baseurl.'/components/com_jschuetze/assets/css/koenigschronik_pinned.css');
        break;
    case 4:
        $document->addStyleSheet($this->baseurl.'/components/com_jschuetze/assets/css/koenigschronik_pinned2.css');
        break;
}
?> 
<div class="componentheading"><b><?php echo $menutitle; ?></b></div>
<div>
    <?php
    if ( $this->params->get('show_headerimage') == 1) 
    {
        if ( $this->params->get('headerimage_left_right') == 1){
        ?>
            <img style="float:right; padding:1em;" src="<?php echo $this->params->get('headerimage'); ?>" alt="" title=""/>
        <?php
        }else {
        ?>
            <img style="float:left; padding:1em;" src="<?php echo $this->params->get('headerimage'); ?>" alt="" title=""/>
        <?php    
        }

    }
    if ( $this->params->get('show_page_heading') == 1) 
    {
    ?>
        <h1 style="vertical-align:middle; display:table-cell; padding:2em;"><?php echo $this->params->get('page_heading'); ?></h1><p />
    <?php    
    }    
    ?>
</div>
<div style="width:100%; text-align: justify; text-justify: newspaper"><?php echo $this->params->get('preamble'); ?></div>
<p style="clear:both;"></p>
<div class="page_body"> 
    <div class="kingsgallery">
        <?php foreach ($this->kings as $n => $king): ?>
            <div class="fotoframe">
                <span class="saison"><?php echo $king->periode; ?></span>
                <img  src="<?php if (empty($king->award_foto_url)){ if (empty($king->member_foto_url)){echo $this->params->get('noimage');} else {echo $king->member_foto_url;} }else{ echo $king->award_foto_url; } ?>" title="" alt="" />
                <span class="bildbefestigung"></span>
                <span class="<?php if(empty($king->zug)){ echo'name';} else { echo 'name_und_zug';} ?>"><?php echo JTEXT::_('COM_JSCHUETZE_MAJESTY').' '.$king->vorname.' '.$king->titel.' '.$king->name; if(!empty($king->zug)){echo '<br />' . $king->zug;} ?></span>
            </div>
        <?php endforeach; ?>
    </div>
<p style="clear:both;"></p>
<br /><br />        
<center>jSchützenzug v<?php echo _JSCHUETZE_VERSION; ?></center>
<center>Copyright &copy; <?php echo date('Y', time() )?> by Hanjo Hingsen, Webmaster of  <a href="http://www.treu-zu-kaarst.de">http://www.treu-zu-kaarst.de</a>, All Rights reserved</center>
</div>