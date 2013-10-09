<?php
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/controllers/adressliste.php                      //
// @implements  : jSchuetzeControllerAdressliste                        //
// @description : Special-Frontend-Controller-File                      //
//                for the jSchuetze-Component                           //
// Version      : 1.0.9                                                //
// *********************************************************************//
// No direct access.
defined('_JEXEC') or die( 'Restricted Access' );
// Include dependancy of the main controllerform class
jimport('joomla.application.component.controllerform');
 
class jSchuetzeControllerAdressliste extends JControllerForm
{
 
    public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, array('ignore_request' => false));
    }
        
    // public function getPDF()
    // {
       // $this->getModel()->getPDF();
    // }
 
}
?>