<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/models/memberawards.php                         //
// @implements  : Class jSchuetzeModelmemberawards                      //
// @description : Model for the DB-Manipulation of the                  //
//                jSchuetze-Memberawards-List                           //
// Version      : 1.1.4                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport( 'joomla.application.component.modellist' );

class jSchuetzeModelMemberawards extends JModelList
{
    /**
     * Constructor.
     *
     * @param array	An optional associative array of configuration settings.
     * @see		JController
     * @since	1.6
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array('id', 'member', 'auszeichnung', 'auszeichnungsdatum', 'periode', 'foto_url');
        }
        parent::__construct($config);
    }
    
	/**
	 * Returns the query
	 * @return string The query to be used to retrieve the rows from the database
	 */
	protected function getListQuery()
	{
        $db    = JFactory::getDBO();
        $query = $db->getQuery(true);

        // Select some fields
        $query->select("CONCAT(member.vorname , ' ', member.name) AS member, award.name AS auszeichnung, periode, aus.id, auszeichnungsdatum, aus.foto_url");
        $query->from('#__jschuetze_mitgliedsausz   AS aus');
        $query->join('LEFT', '#__jschuetze_auszeichnungen AS award  ON (aus.fk_auszeichnung = award.id)');
        $query->join('LEFT', '#__jschuetze_mitglieder     AS member ON (aus.fk_mitglied     = member.id)');

        //Search
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $search = $db->Quote('%'.$db->escape($search, true).'%', false);
            $query->where('(member.name LIKE '.$search.') OR (award.name LIKE '.$search.') ');
        }

        //Filter by period
        $period = $this->getState('filter.period');
        if (!empty($period)) {
            $period = $db->Quote('%'.$db->escape($period, true).'%', false);
            $query->where('(periode LIKE '.$period.')');
        }

        //Filter by Member-ID
        $member = $this->getState('filter.member');
        if (is_numeric($member)) {
            $query->where('fk_mitglied = '.(int)$member);
        }

        //Filter by Award
        $award = $this->getState('filter.award');
        if (is_numeric($award)) {
            $query->where('aus.fk_auszeichnung = '.(int)$award);
        }

        //Add the list ordering clause.
        $orderCol  = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        if (empty($orderCol)){
            $orderCol  = 'auszeichnungsdatum';
            $orderDirn = 'DESC';
        }
        $query->order($db->escape($orderCol.' '.$orderDirn));
        
        return $query;
	}
   
    protected function populateState($ordering = null, $direction = null)
    {
        $search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
        $this->setState('filter.search', $search);
     
        $member = $this->getUserStateFromRequest($this->context.'.filter.member', 'filter_member', '', 'string');
        $this->setState('filter.member', $member);

        $award = $this->getUserStateFromRequest($this->context.'.filter.award', 'filter_award', '', 'string');
        $this->setState('filter.award', $award);

        $period = $this->getUserStateFromRequest($this->context.'.filter.period', 'filter_period', '', 'string');
        $this->setState('filter.period', $period);

        // List state information.
        parent::populateState('auszeichnungsdatum', 'desc');
    }

    
}
?>