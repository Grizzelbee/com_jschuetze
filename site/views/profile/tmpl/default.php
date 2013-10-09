<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : site/views/profile/tmpl/default.php                   //
// @implements  :                                                       //
// @description : Entry-File for the jSchuetze-Profile-View             //
// Version      : 1.1.3                                                 //
// *********************************************************************//
//Aufruf nur durch Joomla! zulassen
defined('_JEXEC')or die('Restricted access'); 
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
// get document to add scripts or StyleSheets
$document = JFactory::getDocument();
$document->addStyleSheet($this->baseurl.'/components/com_jschuetze/assets/css/fundus.css');
$active    = $this->menu->getActive();
$menutitle = $active->title;
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
    <?php if ( empty ($this->item) ) {
        echo JText::_('COM_JSCHUETZE_ERROR_PROFILE_NOT_LINKED_TO_JOOMLA');
    } else { ?>
        
        <form name="profileform" id="profileform" action="<?php JRoute::_('index.php'); ?>" target="_top" method="post">
            <fieldset>
                <legend><?php echo $menutitle; ?></legend>
                <div>
                    <dl>
                        <dt>
                            <label for="name" class="hasTip required" title="<?php echo JText::_('COM_JSCHUETZE_NAME_DESC'); ?>"><?php echo JText::_('COM_JSCHUETZE_NAME'); ?>:</label>
                            <dd><input name="name" id="name" value="<?php echo $this->item->name; ?>" /></dd>
                        </dt>
                        <dt> 
                            <label for="vorname" class="hasTip required" title="<?php echo JText::_('COM_JSCHUETZE_VORNAME_DESC'); ?>"><?php echo JText::_('COM_JSCHUETZE_VORNAME'); ?>:</label>
                            <dd><input name="vorname" id="vorname" value="<?php echo $this->item->vorname; ?>" /></dd> 
                        </dt> 
                        <dt> 
                            <label for="strasse" class="hasTip required" title="<?php echo JText::_('COM_JSCHUETZE_STRASSE_DESC'); ?>"><?php echo JText::_('COM_JSCHUETZE_STREET'); ?>:</label>
                            <dd><input name="strasse" id="strasse" value="<?php echo $this->item->strasse; ?>" /></dd> 
                        </dt> 
                        <dt> 
                            <label for="plz" class="hasTip required" title="<?php echo JText::_('COM_JSCHUETZE_PLZ_DESC'); ?>"><?php echo JText::_('COM_JSCHUETZE_PLZ'); ?>:</label>
                            <dd><input name="plz" id="plz" value="<?php echo $this->item->plz; ?>" /></dd> 
                        </dt> 
                        <dt> 
                            <label for="ort" class="hasTip required" title="<?php echo JText::_('COM_JSCHUETZE_ORT_DESC'); ?>"><?php echo JText::_('COM_JSCHUETZE_ORT'); ?>:</label>
                            <dd><input name="ort" id="ort" value="<?php echo $this->item->ort; ?>" /></dd> 
                        </dt> 
                        <dt> 
                            <label for="vorname" class="hasTip required" title="<?php echo JText::_('COM_JSCHUETZE_EMAIL_DESC'); ?>"><?php echo JText::_('COM_JSCHUETZE_EMAIL'); ?>:</label>
                            <dd><input name="email_priv" id="email_priv" value="<?php echo $this->item->email_priv; ?>" /></dd> 
                        </dt> 
                        <dt> 
                            <label for="change_joomla_mail" class="hasTip required" title="<?php echo JText::_('COM_JSCHUETZE_CHANGE_JOOMLA_MAIL_DESC'); ?>"><?php echo JText::_('COM_JSCHUETZE_CHANGE_JOOMLA_MAIL'); ?>:</label>
                            <dd>
                                <input type="radio" name="change_joomla_mail" id="change_joomla_mail" value="1"><?php echo JText::_('JYES');?></input>
                                <input type="radio" name="change_joomla_mail" id="change_joomla_mail" value="0" checked><?php echo JText::_('JNO');?></input>
                            </dd> 
                        </dt> 
                        <dt> 
                            <label for="tel" class="hasTip required" title="<?php echo JText::_('COM_JSCHUETZE_TEL_DESC'); ?>"><?php echo JText::_('COM_JSCHUETZE_PHONE'); ?>:</label>
                            <dd><input name="tel" id="tel" value="<?php echo $this->item->tel; ?>" /></dd> 
                        </dt> 
                        <dt> 
                            <label for="mobile" class="hasTip required" title="<?php echo JText::_('COM_JSCHUETZE_MOBILE_DESC'); ?>"><?php echo JText::_('COM_JSCHUETZE_MOBILE'); ?>:</label>
                            <dd><input name="mobile" id="mobile" value="<?php echo $this->item->mobile; ?>" /></dd> 
                        </dt> 
                        <dt> 
                            <label for="geburtstag" class="hasTip required" title="<?php echo JText::_('COM_JSCHUETZE_GEBURTSTAG_DESC'); ?>"><?php echo JText::_('COM_JSCHUETZE_BIRTHDAY'); ?>:</label>
                            <dd><input name="geburtstag" id="geburtstag" value="<?php echo $this->item->geburtstag; ?>" /></dd> 
                        </dt> 
                        <dt> 
                            <label for="religion" class="hasTip required" title="<?php echo JText::_('COM_JSCHUETZE_RELIGION_DESC'); ?>"><?php echo JText::_('COM_JSCHUETZE_RELIGION'); ?>:</label>
                            <dd><input name="religion" id="religion" value="<?php echo $this->item->religion; ?>" /></dd> 
                        </dt> 
                        <dt> 
                            <label for="scet_mail_notification" class="hasTip required" title="<?php echo JText::_('COM_JSCHUETZE_SCET_MAIL_NOTIFICATION_DESC'); ?>"><?php echo JText::_('COM_JSCHUETZE_SCET_MAIL_NOTIFICATION'); ?>:</label>
                            <dd>
                                <input type="radio" name="scet_mail_notification" id="scet_mail_notification" value="1" <?php if ( (int)$this->item->scet_mail_notification == 1) {echo 'checked';}; ?>><?php echo JText::_('JYES');?></input>
                                <input type="radio" name="scet_mail_notification" id="scet_mail_notification" value="0" <?php if ( (int)$this->item->scet_mail_notification == 0) {echo 'checked';}; ?>><?php echo JText::_('JNO');?></input>
                            </dd> 
                        </dt> 
                    </dl>
                </div>
            </fieldset>
            <div clear="both">
                <button type="submit" class="validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>
                <?php echo JText::_('COM_JSCHUETZE_OR'); ?>
                <a href="<?php echo JRoute::_(''); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
                <input type='hidden' name='option'     value='com_jschuetze' />
                <input type='hidden' name='task'       value='profile.save' />
                <input type='hidden' name='id'         value='<?php echo $this->item->id; ?>' />
                <input type='hidden' name='jUserID'    value='<?php echo $this->user->id; ?>' />
                <?php echo JHtml::_('form.token'); ?>
            </div>
        </form>
    <?php 
    }
    ?>
    <br><br>        
    <center>jSchützenzug v<?php echo _JSCHUETZE_VERSION; ?></center>
    <center>Copyright &copy; <?php echo date('Y', time() )?> by Hanjo Hingsen, Webmaster of  <a href="http://www.treu-zu-kaarst.de">http://www.treu-zu-kaarst.de</a>, All Rights reserved</center>
</div>