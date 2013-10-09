<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/views/navigation.inc.php                        //
// @implements  :                                                       //
// @description : Code-Snippet for the Menu-Toolbar which is used in    //
//                in the List-Views                                     //
// Version      : 1.0.0                                                 //
// *********************************************************************//
// get document to add scripts or StyleSheets
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root().'media/com_jschuetze/css/views.css');
$viewName = $this->getName();
?>
<div id="navcontainer">
    <ul id="navlist">
        <li<?php if ($viewName == 'members') echo ' id="active"';?>><a href="<?php echo JRoute::_('index.php?option=com_jschuetze&view=members'); ?>"><?php echo JText::_( 'COM_JSCHUETZE_MANAGE_MEMBERS' ); ?></a></li>
        <li<?php if ($viewName == 'titles')  echo ' id="active"';?>><a href="<?php echo JRoute::_('index.php?option=com_jschuetze&view=titles'); ?>"><?php  echo JText::_( 'COM_JSCHUETZE_MANAGE_TITLES' ); ?></a></li>
        <li<?php if ($viewName == 'states')  echo ' id="active"';?>><a href="<?php echo JRoute::_('index.php?option=com_jschuetze&view=states'); ?>"><?php  echo JText::_( 'COM_JSCHUETZE_MANAGE_STATES' ); ?></a></li>
        <li<?php if ($viewName == 'awards')  echo ' id="active"';?>><a href="<?php echo JRoute::_('index.php?option=com_jschuetze&view=awards'); ?>"><?php  echo JText::_( 'COM_JSCHUETZE_MANAGE_AWARDS' ); ?></a></li>
        <li<?php if ($viewName == 'memberawards')  echo ' id="active"';?>><a href="<?php echo JRoute::_('index.php?option=com_jschuetze&view=memberawards'); ?>"><?php  echo JText::_( 'COM_JSCHUETZE_MANAGE_MEMBERAWARDS' ); ?></a></li>
        <li<?php if ($viewName == 'memberranks')   echo ' id="active"';?>><a href="<?php echo JRoute::_('index.php?option=com_jschuetze&view=memberranks'); ?>"><?php  echo JText::_( 'COM_JSCHUETZE_MANAGE_MEMBERRANKS' ); ?></a></li>
    </ul>
</div>