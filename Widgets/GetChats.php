<?php

/**
 * Hazelchat for Matomo.
 *
 * @link https://hazelchat.co/integrations/matomo/
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\Hazelchat\Widgets;

use Piwik\Common;
use Piwik\Nonce;
use Piwik\Piwik;
use Piwik\Plugins\Hazelchat\Chats;
use Piwik\Widget\Widget;
use Piwik\Widget\WidgetConfig;

/**
 * The chat's three events for the selected website, period and segment, and,
 * for users who may change the website's goals, "Count enquiries as a goal"
 * until that goal exists. Also available on dashboards.
 */
class GetChats extends Widget
{
    public static function configure(WidgetConfig $config)
    {
        $config->setCategoryId('General_Actions');
        $config->setSubcategoryId('Hazelchat_Hazelchat');
        $config->setName('Hazelchat_WidgetName');
        $config->setOrder(1);
        $config->setIsWide();
    }

    public function render()
    {
        $idSite = Common::getRequestVar('idSite', 0, 'int');
        Piwik::checkUserHasViewAccess($idSite);

        $counts = Chats::counts();
        $goal = Chats::findGoal($idSite);
        $canAddGoal = $goal === null && Piwik::isUserHasWriteAccess($idSite);

        return $this->renderTemplate('getChats', array(
            'counts' => $counts,
            'hasEvents' => array_sum($counts) > 0,
            'goal' => $goal,
            'canAddGoal' => $canAddGoal,
            'nonce' => $canAddGoal ? Nonce::getNonce(Chats::GOAL_NONCE) : '',
            'idSite' => $idSite,
            'period' => Common::getRequestVar('period', 'day', 'string'),
            'date' => Common::getRequestVar('date', 'today', 'string'),
        ));
    }
}
