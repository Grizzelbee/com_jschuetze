<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/controllers/Memberfiles.raw.php                  //
// @implements  : jSchuetzeControllerMemberfiles                        //
// @description : Special-Frontend-Controller-File                      //
//                for the jSchuetze-Component                           //
// Version      : 1.1.2                                                 //
// *********************************************************************//
// No direct access.
defined('_JEXEC') or die( 'Restricted Access' );
// Include dependancy of the main controllerform class
jimport('joomla.application.component.controllerform');
 
class jSchuetzeControllerMemberfiles extends JControllerForm
{
 
    public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, array('ignore_request' => false));
    }
        
    
    public function getVCardAsFile()
    {
        $content  = $this->getModel()->getVCardAsFile(JRequest::getVar('userid'));
        $filename = JRequest::getVar('filename');
        
        JResponse::setHeader('Content-Type', 'text/plain');
        JResponse::setHeader('Content-Transfer-Encoding', 'Binary');
        JResponse::setHeader('Content-Disposition', 'attachment; filename='.$filename.'.vcf');
        JResponse::setHeader('Content-Length', strlen($content) );

        echo $content;
    }

}
?>