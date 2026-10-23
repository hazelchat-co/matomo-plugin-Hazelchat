<?php

/**
 * Hazelchat for Matomo.
 *
 * @link https://hazelchat.co/integrations/matomo/
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\Hazelchat;

use Piwik\API\Request;
use Piwik\Common;
use Piwik\Nonce;
use Piwik\Piwik;
use Piwik\Url;

class Controller extends \Piwik\Plugin\Controller
{
    /**
     * "Count enquiries as a goal": creates the goal "Hazelchat enquiry"
     * (event action is exactly "Chat enquiry", once per visit) for one
     * website, unless it exists, then returns to Behaviour › Hazelchat.
     * POST only, with the form's nonce; Goals.addGoal checks write access.
     */
    public function addGoal()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new \Exception('POST only.');
        }
        Nonce::checkNonce(Chats::GOAL_NONCE, Common::getRequestVar('nonce', '', 'string', $_POST));
        $idSite = Common::getRequestVar('idSite', 0, 'int');
        Piwik::checkUserHasWriteAccess($idSite);

        if (Chats::findGoal($idSite) === null) {
            Request::processRequest('Goals.addGoal', array(
                'idSite' => $idSite,
                'name' => Piwik::translate('Hazelchat_GoalName'),
                'matchAttribute' => 'event_action',
                'pattern' => Hazelchat::GOAL_PATTERN,
                'patternType' => 'exact',
                'caseSensitive' => 1,
                'revenue' => 0,
                'allowMultipleConversionsPerVisit' => 0,
                'description' => Piwik::translate('Hazelchat_GoalDescription'),
            ), array());
        }

        $period = Common::getRequestVar('period', 'day', 'string');
        $date = Common::getRequestVar('date', 'today', 'string');
        $query = Url::getQueryStringFromParameters(array(
            'module' => 'CoreHome',
            'action' => 'index',
            'idSite' => $idSite,
            'period' => $period,
            'date' => $date,
        ));
        $hash = Url::getQueryStringFromParameters(array(
            'idSite' => $idSite,
            'period' => $period,
            'date' => $date,
            'category' => 'General_Actions',
            'subcategory' => 'Hazelchat_Hazelchat',
        ));
        Url::redirectToUrl('index.php?' . $query . '#?' . $hash);
    }
}
