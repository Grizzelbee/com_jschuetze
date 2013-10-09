<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/views/adressliste/tmpl/default.php               //
// @implements  :                                                       //
// @description : Entry-File for the jSchuetze-adressliste-View         //
// Version      : 1.1.3                                                 //
// *********************************************************************//
//Aufruf nur durch Joomla! zulassen
defined('_JEXEC')or die('Restricted access'); 
// get document to add scripts or StyleSheets
$document = JFactory::getDocument();
$document->addStyleSheet($this->baseurl.'/components/com_jschuetze/assets/css/adressliste.css');
$active    = $this->menu->getActive();
$menutitle = $active->title;
$this->model->setPagehit($menutitle);

?> 
<div class="componentheading"><b><?php echo $menutitle; ?></b></div>
<div>
    <?php
    if ( $this->params->get('show_headerimage') == 1) 
    {
        if ( $this->params->get('headerimage_left_right') == 1){
    ?>
            <img style="float:right; margin-left:20px;" src="<?php echo $this->params->get('headerimage'); ?>" alt="" title=""/>
    <?php
        }else {
    ?>
            <img style="float:left; margin-right:20px;" src="<?php echo $this->params->get('headerimage'); ?>" alt="" title=""/>
    <?php
        }
    }
    if ( $this->params->get('show_page_heading') == 1) 
    {
    ?>
        <h1 style="vertical-align:middle;"><?php echo $this->params->get('page_heading'); ?></h1><p />
        <div style="width:100%; text-align: justify; text-justify: newspaper"><?php echo $this->params->get('preamble'); ?></div>
        <p style="clear:both;"></p>
    <?php
    }    
    ?>
</div>
<div class="page_body"> 
<?php 
    switch($this->params->get('listkind'))
    {
        case 1: // Adressliste
            $link_CSV = JRoute::_( 'index.php?option=com_jschuetze&task=adressliste.getAdressCSV&format=raw&filename='.$this->params->get('filename') );
            $link_PDF = JRoute::_( 'index.php?option=com_jschuetze&task=adressliste.getAdressPDF&format=raw&filename='.$this->params->get('filename').'&pdf_headline='.$this->params->get('pdf_headline').'&pdf_subtitle='.$this->params->get('pdf_subtitle') );
            break;
        case 2: // Bruderschaftsliste
            $link_CSV = JRoute::_( 'index.php?option=com_jschuetze&task=adressliste.getBrotherhoodCSV&format=raw&filename='.$this->params->get('filename') );
            $link_PDF = JRoute::_( 'index.php?option=com_jschuetze&task=adressliste.getBrotherhoodPDF&format=raw&filename='.$this->params->get('filename').'&pdf_headline='.$this->params->get('pdf_headline').'&pdf_subtitle='.$this->params->get('pdf_subtitle') );
            break;
    }
    $link          = JRoute::_( 'index.php?option=com_jschuetze&task=adressliste.getCSV&format=raw&filename='.$this->params->get('filename'));
    $image         = '<img style="float:right; width:64px; height: 64px;" src="components/com_jschuetze/assets/images/csv_dl.png" alt="'.JTEXT::_('COM_JSCHUETZE_GENERATE_CSV').'" title="'.JTEXT::_('COM_JSCHUETZE_GENERATE_CSV').'"/>';
    $csv_imageLink = '<a class="jgrid" href="'.$link_CSV.'")" title="'.JText::_('COM_JSCHUETZE_GENERATE_CSV').'">'.$image. '</a>';
    
    $image         = '<img style="float:right; width:64px; height: 64px;" src="components/com_jschuetze/assets/images/pdf_dl.png" alt="'.JTEXT::_('COM_JSCHUETZE_GENERATE_PDF').'" title="'.JTEXT::_('COM_JSCHUETZE_GENERATE_PDF').'"/>';
    $pdf_imageLink = '<a class="jgrid" href="'.$link_PDF.'")" title="'.JText::_('COM_JSCHUETZE_GENERATE_PDF').'">'.$image. '</a>';
?>    
<p name="download_icons" id="download_icons" style="clear:both"><?php echo $csv_imageLink.$pdf_imageLink; ?></p>
<div name="content" id="content">
<?php echo $this->content->text; ?>
</div>

<br><br>        
<center>jSchützenzug v<?php echo _JSCHUETZE_VERSION; ?></center>
<center>Copyright &copy; <?php echo date('Y', time() )?> by Hanjo Hingsen, Webmaster of  <a href="http://www.treu-zu-kaarst.de">http://www.treu-zu-kaarst.de</a>, All Rights reserved</center>
</div>