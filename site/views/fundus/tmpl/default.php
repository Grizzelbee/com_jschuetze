<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/views/Memberfiles/tmpl/default.php               //
// @implements  :                                                       //
// @description : Entry-File for the jSchuetze-Standard-View            //
// Version      : 1.0.8                                                 //
// *********************************************************************//
//Aufruf nur durch Joomla! zulassen
defined('_JEXEC')or die('Restricted access'); 
// get document to add scripts or StyleSheets
$document = JFactory::getDocument();
$document->addStyleSheet($this->baseurl.'/components/com_jschuetze/assets/css/fundus.css');
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

<table class="fundustable">
    <thead>
        <tr>
            <th style="width: 64%;"><?php echo JText::_('COM_JSCHUETZE_ITEM')?></th>
            <th style="width: 10%;"><?php echo JText::_('COM_JSCHUETZE_FEE') ?></th>
            <th style="width:  8%;"><?php echo JText::_('COM_JSCHUETZE_ANZAHL') ?></th>
            <th style="width:  8%;"><?php echo JText::_('COM_JSCHUETZE_BESTAND') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            if (!empty($this->items)){
                foreach($this->items as $i => $item) {           // loop through all Items ?>
                    <tr> 
                        <td class="td_left"><?php   echo $item->name; ?></td> 
                        <td class="td_center"><?php echo $item->fee; ?>&nbsp;€</td> 
                        <td class="td_center"><?php echo $item->anzahl; ?></td> 
                        <td class="td_center"><?php echo $item->bestand; ?></td> 
                    </tr> 
                    <?php 
                } //end foreach-Items
            }?> 
    </tbody>
</table> 



<br><br>        
<center>jSchützenzug v<?php echo _JSCHUETZE_VERSION; ?></center>
<center>Copyright &copy; <?php echo date('Y', time() )?> by Hanjo Hingsen, Webmaster of  <a href="http://www.treu-zu-kaarst.de">http://www.treu-zu-kaarst.de</a>, All Rights reserved</center>
</div>