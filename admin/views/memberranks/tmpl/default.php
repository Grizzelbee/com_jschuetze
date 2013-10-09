<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/views/memberranks/tmpl/default.php              //
// @implements  :                                                       //
// @description : Template for the memberranks-List-View                //
// Version      : 1.0.0                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC')or die('Restricted access'); 
JHTML::_('behavior.tooltip'); 
JHTML::_('behavior.multiselect'); 
require(JPATH_COMPONENT.DS.'views'.DS.'navigation.inc.php');
?> 
<form action="<?php echo JRoute::_('index.php?option=com_jschuetze&view=memberranks'); ?>" method="post" name="adminForm">

	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_JSCHUETZE_ITEMS_SEARCH_FILTER'); ?>" />
			<button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
        <div class="filter-select fltrt">
            <select name="filter_member" class="inputbox" onchange="this.form.submit()">
                <?php echo JHtml::_('select.options', JFormFieldMember::getOptions(), 'value', 'text', $this->state->get('filter.member'), true);?>
            </select>
            <select name="filter_rank" class="inputbox" onchange="this.form.submit()">
                <?php echo JHtml::_('select.options', JFormFieldRank::getOptions(), 'value', 'text', $this->state->get('filter.rank'), true);?>
            </select>
        </div>
    </fieldset>
    
    <table class="adminlist">
        <thead>
            <tr>
                <th width="5">
                    <?php echo JText::_( '#' ); ?>
                </th>
                <th width="20">
                    <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
                </th>
                <th class="title">
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_MEMBER', 'member', $this->listDirn, $this->listOrder); ?>
               </th>
                <th width="30%" align="center">
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_RANK', 'rang', $this->listDirn, $this->listOrder); ?>
                </th>
                <th width="20%" align="center">
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_FUNKTION_SEIT', 'funktion_seit', $this->listDirn, $this->listOrder); ?>
               </th>
                <th width="10%" align="center">
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_FUNKTION_BIS', 'funktion_bis', $this->listDirn, $this->listOrder); ?>
               </th>
                <th width="5">
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_ID', 'id', $this->listDirn, $this->listOrder); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php  
            foreach($this->items as $i => $item) : 
            $link           = JRoute::_( 'index.php?option=COM_JSCHUETZE&task=memberrank.edit&cid[]='.(int)$item->id );
            $singleItemLink = JRoute::_( 'index.php?option=COM_JSCHUETZE&task=memberrank.edit&id='.(int)$item->id );
   			$ordering	= ($this->listOrder == 'ordering');
            ?>
                <tr class="row<?php echo $i % 2; ?>">
                    <td><?php echo sprintf('%02d', $this->pagination->limitstart+$i+1); ?></td>
                    <td><?php echo JHTML::_('grid.id', $i, $item->id); ?></td>
                    <td><a href="<?php echo $singleItemLink; ?>"><?php echo $item->member; ?></a></td>
                    <td><a href="<?php echo $singleItemLink; ?>"><?php echo $item->rang; ?></a></td>
                    <td align="left"><?php echo $item->funktion_seit; ?></td>
                    <td align="center"><?php echo $item->funktion_bis; ?></td>
                    <td><?php echo $item->id; ?></td>
                </tr>
            <?php 
            endforeach; 
            ?>
        <tbody>
        <tfoot>
            <tr>
                <td colspan="10">
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
