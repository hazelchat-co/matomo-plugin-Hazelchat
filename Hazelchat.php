<?php

/**
 * Hazelchat for Matomo.
 *
 * @link https://hazelchat.co/integrations/matomo/
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\Hazelchat;

/**
 * The Hazelchat AI chat agent in Matomo.
 *
 * - Template/Tag: a Tag Manager tag that adds the chat to a website.
 * - Widgets, Categories, Controller: a "Hazelchat" page under Behaviour with
 *   the chat's events for the period and one action, "Count enquiries as a
 *   goal".
 *
 * The events themselves come from the Hazelchat chat on the website, through
 * the website's own Matomo tracker (category "Hazelchat"). This plugin adds
 * no tracker code, no database table and no outgoing request: nothing is
 * sent to Hazelchat by Matomo.
 */
class Hazelchat extends \Piwik\Plugin
{
    /** The event category the Hazelchat chat uses. */
    public const EVENT_CATEGORY = 'Hazelchat';

    /**
     * The event actions, in the order the page shows them. English in every
     * language, so goals and segments built on them keep working.
     */
    public const EVENT_ACTIONS = array(
        'opened' => 'Chat opened',
        'started' => 'Chat started',
        'enquiry' => 'Chat enquiry',
    );

    /** The goal "Count enquiries as a goal" creates. */
    public const GOAL_PATTERN = 'Chat enquiry';

    public function registerEvents()
    {
        return array(
            'AssetManager.getStylesheetFiles' => 'getStylesheetFiles',
        );
    }

    public function getStylesheetFiles(&$files)
    {
        $files[] = 'plugins/Hazelchat/stylesheets/hazelchat.less';
    }

    public function isTrackerPlugin()
    {
        return false;
    }
}
