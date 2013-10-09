<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/models/memberranks.php                         //
// @implements  : Class jSchuetzeModelmemberranks                      //
// @description : Model for the DB-Manipulation of the                  //
//                jSchuetze-Memberranks-List                           //
// Version      : 1.1.4                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport( 'joomla.application.component.modellist' );

class jSchuetzeModelMemberranks extends JModelList
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
            $config['filter_fields'] = array('id', 'member', 'rang', 'funktion_seit', 'funktion_bis');
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
        $query->select("CONCAT(member.vorname , ' ', member.name) AS member, title.name AS rang, funktion_seit, funktion_bis, rank.id");
        $query->from('#__jschuetze_memberranks   AS rank');
        $query->join('', '#__jschuetze_titel     AS title  ON (rank.fk_funktion   = title.id)');
        $query->join('', '#__jschuetze_mitglieder AS member ON (rank.fk_mitglied = member.id)');

        //Search
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $search = $db->Quote('%'.$db->escape($search, true).'%', false);
            $query->where('(member.name LIKE '.$search.') OR (rank.name LIKE '.$search.') ');
        }

        // Filter by published state
        // $published = $this->getState('filter.state');
        // if (is_numeric($published)) {
            // $query->where('published = '.(int) $published);
        // } else if ($published == '') {
            // $query->where('(published IN (0, 1))');
        // }

        //Filter by Rank-ID
        $rank = $this->getState('filter.rank');
        if (is_numeric($rank)) {
            $query->where('rank.fk_funktion = '.(int)$rank);
        }

        //Filter by Member-ID
        $member = $this->getState('filter.member');
        if (is_numeric($member)) {
            $query->where('rank.fk_mitglied = '.(int)$member);
        }

        //Add the list ordering clause.
        $orderCol  = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        if (empty($orderCol)){
            $orderCol  = 'funktion_bis, funktion_seit';
            $orderDirn = 'desc';
        }
        $query->order($db->escape($orderCol.' '.$orderDirn));
        
        return $query;
	}
   

    protected function populateState($ordering = null, $direction = null)
    {
        $search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
        $this->setState('filter.search', $search);
     
        // $state = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_state', '', 'string');
        // $this->setState('filter.state', $state);

        $member = $this->getUserStateFromRequest($this->context.'.filter.member', 'filter_member', '', 'string');
        $this->setState('filter.member', $member);

        $rank = $this->getUserStateFromRequest($this->context.'.filter.rank', 'filter_rank', '', 'string');
        $this->setState('filter.rank', $rank);

        // List state information.
        parent::populateState('funktion_bis, funktion_seit', 'desc');
    }

    
}
?>