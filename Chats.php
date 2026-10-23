<?php

/**
 * Hazelchat for Matomo.
 *
 * @link https://hazelchat.co/integrations/matomo/
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\Hazelchat;

use Piwik\API\Request;
use Piwik\DataTable;

/** Reads the chat's events and the enquiry goal through Matomo's own API. */
class Chats
{
    public const GOAL_NONCE = 'Hazelchat.addGoal';

    /**
     * Event counts for the request's website, period, date and segment,
     * keyed like Hazelchat::EVENT_ACTIONS. Read from the Events report
     * (category › action), so the numbers match Behaviour › Events.
     *
     * @return array<string,int>
     */
    public static function counts()
    {
        $counts = array_fill_keys(array_keys(Hazelchat::EVENT_ACTIONS), 0);
        $table = Request::processRequest('Events.getCategory', array(
            'secondaryDimension' => 'eventAction',
            'flat' => 1,
            'filter_limit' => -1,
            'format' => 'original',
            'disable_generic_filters' => 0,
        ));
        if ($table instanceof DataTable\Map) {
            $table = $table->mergeChildren();
        }
        if (!$table instanceof DataTable) {
            return $counts;
        }
        foreach ($table->getRows() as $row) {
            foreach (Hazelchat::EVENT_ACTIONS as $id => $action) {
                if ($row->getColumn('label') === Hazelchat::EVENT_CATEGORY . ' - ' . $action) {
                    $counts[$id] += (int) $row->getColumn('nb_events');
                }
            }
        }
        return $counts;
    }

    /**
     * The website's goal on the enquiry event, by what it matches rather
     * than by its name, so a goal the owner renamed still counts.
     *
     * @return array|null
     */
    public static function findGoal($idSite)
    {
        $goals = Request::processRequest('Goals.getGoals', array('idSite' => $idSite, 'filter_limit' => -1), array());
        foreach ((array) $goals as $goal) {
            if (
                isset($goal['match_attribute'], $goal['pattern'], $goal['pattern_type'])
                && $goal['match_attribute'] === 'event_action'
                && $goal['pattern_type'] === 'exact'
                && $goal['pattern'] === Hazelchat::GOAL_PATTERN
            ) {
                return $goal;
            }
        }
        return null;
    }
}
