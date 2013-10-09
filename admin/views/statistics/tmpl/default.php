<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/views/Statistics/tmpl/default.php               //
// @implements  :                                                       //
// @description : Template for the Statistics-List-View                 //
// Version      : 1.1.3                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC')or die('Restricted access'); 
JHTML::_('behavior.tooltip'); 
JHTML::_('behavior.multiselect'); 
require(JPATH_COMPONENT.DS.'views'.DS.'navigation.inc.php');
?> 
<form action="<?php echo JRoute::_('index.php?option=com_jschuetze&view=statistics'); ?>" method="post" name="adminForm" id="adminForm">
    <table class="adminlist">
        <thead>
            <tr>
                <th width="5%">
                    <?php echo JText::_( '#' ); ?>
                </th>
                <th width="3%">
                    <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
                </th>
                <th class="title">
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_VIEWNAME', 'viewname', $this->listDirn, $this->listOrder); ?>
                </th>
                <th width="20%" align="center">
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_HITS', 'hits', $this->listDirn, $this->listOrder); ?>
                </th>
                <th width="3%">
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_ID', 'id', $this->listDirn, $this->listOrder); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php  
            if (!empty($this->items)) {
                foreach($this->items as $i => $item) : 
                ?>
                    <tr class="row<?php echo $i % 2; ?>">
                        <td><?php echo sprintf('%02d', $this->pagination->limitstart+$i+1); ?></td>
                        <td><?php echo JHTML::_('grid.id', $i, $item->id); ?></td>
                        <td><?php echo $item->viewname; ?></td>
                        <td><?php echo $item->hits; ?></td>
                        <td><?php echo $item->id; ?></td>
                    </tr>
                <?php 
                endforeach; 
            }
            ?>
        <tbody>
        <tfoot>
            <tr>
                <td colspan="5">
                    <?php echo $this->pagination->getListFooter() 
                               .'<br>'
                               . $this->pagination->getResultsCounter(); 
                    ?>
                    <p>
                    <center>jSchützenzug  v<?php echo _jSCHUETZE_VERSION; ?></center>
                    <center>Copyright &copy; <?php echo date('Y', time() )?> by Hanjo Hingsen, Webmaster of  <a href="http://www.treu-zu-kaarst.de">http://www.treu-zu-kaarst.de</a>, All Rights reserved</center>
                </td>
            </tr>
        </tfoot>            
    </table> 
    <div>
        <input type="hidden" name="task"             value = "" />
        <input type="hidden" name="boxchecked"       value = "0" />
        <input type="hidden" name="filter_order"     value = "<?php echo $this->listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value = "<?php echo $this->listDirn; ?>" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
