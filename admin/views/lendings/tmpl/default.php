<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/views/lendings/tmpl/default.php                 //
// @implements  :                                                       //
// @description : Template for the lendings-List-View                   //
// Version      : 1.1.3                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC')or die('Restricted access'); 
JHTML::_('behavior.tooltip'); 
JHTML::_('behavior.multiselect'); 
require(JPATH_COMPONENT.DS.'views'.DS.'navigation.inc.php');
?> 
<form action="<?php echo JRoute::_('index.php?option=com_jschuetze&view=lendings'); ?>" method="post" name="adminForm" id="adminForm">

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
            <select name="filter_state" class="inputbox" onchange="this.form.submit()">
                <option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?></option>
                <?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true); ?>
            </select>
        </div>
    </fieldset>
    
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
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_MEMBER', 'name', $this->listDirn, $this->listOrder); ?>
                </th>
                <th width="20%" align="center">
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_ITEM', 'gegenstand', $this->listDirn, $this->listOrder); ?>
                </th>
                <th width="5%" align="center">
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_ANZAHL_AUS', 'anzahl_aus', $this->listDirn, $this->listOrder); ?>
                </th>
                <th width="10%" align="center">
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_DATUM_AUS', 'ausgabe', $this->listDirn, $this->listOrder); ?>
                </th>
                <th width="5%" align="center">
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_FEE_PAIED', 'FEE_PAIED', $this->listDirn, $this->listOrder); ?>
                </th>
                <th width="5%" align="center">
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_ANZAHL_RUECK', 'anzahl_rueck', $this->listDirn, $this->listOrder); ?>
                </th>
                <th width="10%" align="center">
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_DATUM_RUECK', 'rueckgabe', $this->listDirn, $this->listOrder); ?>
                </th>
                <th width="5%" align="center">
                    <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_PUBLISHED', 'published', $this->listDirn, $this->listOrder); ?>
               </th>
                <th width="12%">
                    <span>
                        <?php echo JHTML::_('grid.sort', 'COM_JSCHUETZE_ORDERING', 'ordering', $this->listDirn, $this->listOrder); ?>
                        <?php echo JHTML::_('grid.order', $this->items, 'filesave.png', 'lendings.saveorder'); ?>
                    </span>
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
                $link           = JRoute::_( 'index.php?option=com_jschuetze&task=lending.edit&cid[]='.(int)$item->id );
                $singleItemLink = JRoute::_( 'index.php?option=com_jschuetze&task=lending.edit&id='.(int)$item->id );
                $ordering	= ($this->listOrder == 'ordering');
                ?>
                    <tr class="row<?php echo $i % 2; ?>">
                        <td><?php echo sprintf('%02d', $this->pagination->limitstart+$i+1); ?></td>
                        <td><?php echo JHTML::_('grid.id', $i, $item->id); ?></td>
                        <td><a href="<?php echo $singleItemLink; ?>"><?php echo $item->name; ?></a></td>
                        <td><a href="<?php echo $singleItemLink; ?>"><?php echo $item->gegenstand; ?></a></td>
                        <td align="center"><?php echo $item->anzahl_aus;  ?></td>
                        <td align="center"><?php echo $item->ausgabe; ?></td>
                        <td align="center"><?php echo JHTML::_('jgrid.published', $item->fee_paied, $i, 'lendings.fee_paied' ); ?></td>
                        <td align="center"><?php echo $item->anzahl_rueck . $this->getAddImage($i, $item->itemsopen);  ?></td>
                        <td align="center"><?php echo $item->rueckgabe; ?></td>
                        <td align="center"><?php echo JHTML::_('jgrid.published', $item->published, $i, 'lendings.' ); ?></td>
                        <td class = "order" align="center">
                            <span><?php echo $this->pagination->orderUpIcon($i, (@$this->items[$i-1]->ordering <= $item->ordering), 'lendings.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
                            <span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, (@$this->items[$i+1]->ordering >= $item->ordering), 'lendings.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
                            <input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" class="text-area-order" />
                        </td>
                        <td><?php echo $item->id; ?></td>
                    </tr>
                <?php 
                endforeach; 
            }
            ?>
        <tbody>
        <tfoot>
            <tr>
                <td colspan="11">
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
