<?php 
// *********************************************************************//
// Project      : jSchuetze for Joomla                                  //
// @package     : com_jSchuetze                                         //
// @file        : admin/models/lendings.php                             //
// @implements  : Class jSchuetzeModellendings                          //
// @description : Model for the DB-Manipulation of the                  //
//                jSchuetze-lendings-List                               //
// Version      : 1.1.1                                                 //
// *********************************************************************//
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted Access' ); 
jimport( 'joomla.application.component.modellist' );

class jSchuetzeModellendings extends JModelList
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
            $config['filter_fields'] = array('id', 'name', 'fee_paied', 'gegenstand', 'anzahl_aus', 'ausgabe', 'anzahl_rueck', 'rueckgabe', 'published', 'ordering');
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
        $query->select('CONCAT(member.vorname, \' \', member.name) AS name, fundus.name AS gegenstand, anzahl_aus, ausgabe, anzahl_rueck, rueckgabe, lending.published, lending.ordering,lending.id, (anzahl_aus - anzahl_rueck) AS itemsopen, fee_paied');
        $query->from('#__jschuetze_lending        AS lending');
        $query->join('', '#__jschuetze_fundus     AS fundus ON (lending.fk_fundus   = fundus.id)');
        $query->join('', '#__jschuetze_mitglieder AS member ON (lending.fk_schuetze = member.id)');
		
		
        //Search
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $search = $db->Quote('%'.$db->getEscaped($search, true).'%', false);
            $query->where('(fundus.name LIKE '.$search.') OR (member.name LIKE '.$search.') OR (member.vorname LIKE '.$search.')');
        }

		// @ToDo:
		// hier muss nachgebessert werden. Das SQL zum suchen funktioniert so nicht.
		// vermutlich müssen da noch mindestens zwei Joins rein.
        //Filter by Member-ID

        $member = $this->getState('filter.member');
        if (is_numeric($member)) {
            $query->where('fk_schuetze = '.(int)$member);
        }
		
        // Filter by published state
        $published = $this->getState('filter.state');
        if (is_numeric($published)) {
            $query->where('published = '.(int) $published);
        } else if ($published == '') {
            $query->where('(lending.published IN (0, 1))');
        }

        //Add the list ordering clause.
        $orderCol  = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        if (empty($orderCol)){
            $orderCol  = 'ordering';
            $orderDirn = 'asc';
        }
        $query->order($db->getEscaped($orderCol.' '.$orderDirn));
        
        return $query;
	}
   

    protected function populateState($ordering = null, $direction = null)
    {
        $search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
        $this->setState('filter.search', $search);
     
        $member = $this->getUserStateFromRequest($this->context.'.filter.member', 'filter_member', '', 'string');
        $this->setState('filter.member', $member);

        $state = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_state', '', 'string');
        $this->setState('filter.state', $state);

        // List state information.
        parent::populateState('ordering', 'asc');
    }

    
}
?>