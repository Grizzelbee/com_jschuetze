<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/views/navigation.inc.php                        //
// @implements  :                                                       //
// @description : Code-Snippet for the Menu-Toolbar which is used in    //
//                in the List-Views                                     //
// Version      : 1.1.0                                                 //
// *********************************************************************//
// get document to add scripts or StyleSheets
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root().'media/com_jschuetze/css/views.css');

function getNavContainer($activeView)
{
	$knownViews = array('members', 'memberawards', 'memberranks', 'lendings', 'assets', 'titles', 'states', 'awards', 'statistics');
	$navContainer = '';
    
	foreach ($knownViews as $v => $view):
 		if ($view == $activeView) {
			$activeState = 'id="active"';
		}else {
			$activeState = '';
		}
		$route          = JRoute::_('index.php?option=com_jschuetze&view='.$view);
		$navContainer  .= '<li '.$activeState.'>'; 
		$navContainer  .= '<a href="'.$route.'">'.JTEXT::_('COM_JSCHUETZE_'.$view).'</a></li>';
	endforeach;
	
	return $navContainer;
}
?>
<div id="navcontainer">
    <ul id="navlist">
		<?php echo getNavContainer($this->getName()); ?>
    </ul>
</div>


