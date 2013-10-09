<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/views/lending/tmpl/edit.php                       //
// @implements  :                                                       //
// @description : Template for the single lending Edit-View               //
// Version      : 1.0.7                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); 

JHtml::_('behavior.tooltip'); 
JHtml::_('behavior.keepalive'); 
$url = 'index.php?option=com_jschuetze&layout=edit&id='; 
?> 
<form action="<?php echo JRoute::_($url.(int) $this->item->id); ?>"  	  
      method="post" name="adminForm" id="member-form">      
    <fieldset class="adminform">  
        <legend><?php echo JText::_('COM_JSCHUETZE_DETAILS'); ?></legend>         
        <ul class="adminformlist"> 			
            <?php foreach($this->form->getFieldset() as $field): ?>             
            <li><?php echo $field->label;echo $field->input;?></li> 			
            <?php endforeach; ?>         
        </ul>     
    </fieldset>
    <div>         
        <input type="hidden" name="task" value="jschuetze.lending" />
        <?php echo JHtml::_('form.token'); ?>     
    </div> 
</form>