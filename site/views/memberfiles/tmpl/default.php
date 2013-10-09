<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/views/Memberfiles/tmpl/default.php               //
// @implements  :                                                       //
// @description : Entry-File for the jSchuetze-Standard-View            //
// Version      : 1.0.0                                                 //
// *********************************************************************//
//Aufruf nur durch Joomla! zulassen
defined('_JEXEC')or die('Restricted access'); 
// get document to add scripts or StyleSheets
$document = JFactory::getDocument();
$document->addStyleSheet($this->baseurl.'/components/com_jschuetze/assets/css/memberfiles.css');
// JHtml::_('behavior.tooltip');
// JHtml::_('behavior.formvalidation');
// JHtml::_('behavior.keepalive');
?> 
<div>
    <?php
    if ( $this->params->get('show_headerimage') == 1) 
    {
        if ( $this->params->get('headerimage_left_right') == 1){
            echo '<img style="float:right; margin-left:20px;" src="'.$this->params->get('headerimage').'" alt="" title=""/>';
        }else {
            echo '<img style="float:left; margin-right:20px;" src="'.$this->params->get('headerimage').'" alt="" title=""/>';
        }

    }
    if ( $this->params->get('show_page_heading') == 1) 
    {
        echo '<h1 style="vertical-align:middle;">' . $this->params->get('page_heading') .'</h1><p />';
        echo '<div style="width:100%; text-align: justify; text-justify: newspaper">'. $this->params->get('preamble') . '</div>';
        echo '<p style="clear:both;"></p>';
    }    
    ?>
</div>
<div class="page_body"> 

<?php echo $this->content->text; ?>

<br><br>        
<center>jSchützenzug v<?php echo _JSCHUETZE_VERSION; ?></center>
<center>Copyright &copy; <?php echo date('Y', time() )?> by Hanjo Hingsen, Webmaster of  <a href="http://www.treu-zu-kaarst.de">http://www.treu-zu-kaarst.de</a>, All Rights reserved</center>
</div>