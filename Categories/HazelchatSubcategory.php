<?php

/**
 * Hazelchat for Matomo.
 *
 * @link https://hazelchat.co/integrations/matomo/
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\Hazelchat\Categories;

use Piwik\Category\Subcategory;
use Piwik\Piwik;

/** Behaviour › Hazelchat. */
class HazelchatSubcategory extends Subcategory
{
    protected $categoryId = 'General_Actions';
    protected $id = 'Hazelchat_Hazelchat';
    protected $order = 45;

    public function getHelp()
    {
        return '<p>' . Piwik::translate('Hazelchat_PageHelp') . '</p>';
    }
}
