<?php

/**
 * Hazelchat for Matomo.
 *
 * @link https://hazelchat.co/integrations/matomo/
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\Hazelchat\Template\Tag;

use Piwik\Piwik;
use Piwik\Plugins\Hazelchat\Key;
use Piwik\Plugins\TagManager\Template\Tag\BaseTag;
use Piwik\Settings\FieldConfig;
use Piwik\Validators\NotEmpty;

/**
 * "Hazelchat Chat": loads https://app.hazelchat.co/widget.js with the
 * website's public key, once per page. The key is public (every page with
 * the chat carries it) and grants no access to a Hazelchat account.
 */
class HazelchatTag extends BaseTag
{
    public function getName()
    {
        return Piwik::translate('Hazelchat_TagName');
    }

    public function getDescription()
    {
        return Piwik::translate('Hazelchat_TagDescription');
    }

    public function getHelp()
    {
        return Piwik::translate('Hazelchat_TagHelp');
    }

    public function getCategory()
    {
        return self::CATEGORY_SOCIAL;
    }

    public function getIcon()
    {
        return 'plugins/Hazelchat/images/icon.svg';
    }

    public function getParameters()
    {
        return array(
            $this->makeSetting('hazelchatKey', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) {
                $field->title = Piwik::translate('Hazelchat_TagKeyTitle');
                $field->description = Piwik::translate('Hazelchat_TagKeyDescription');
                $field->uiControlAttributes = array('placeholder' => Piwik::translate('Hazelchat_TagKeyPlaceholder'));
                $field->validators[] = new NotEmpty();
                // The field takes the key or the whole installation code and
                // keeps only the key; anything else is refused.
                $field->validate = function ($value) {
                    if (Key::fromInput($value) === null) {
                        throw new \Exception(Piwik::translate('Hazelchat_TagKeyInvalid'));
                    }
                };
                $field->transform = function ($value) {
                    $key = Key::fromInput($value);
                    return $key === null ? trim((string) $value) : $key;
                };
            }),
            $this->makeSetting('hazelchatWaitForConsent', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
                $field->title = Piwik::translate('Hazelchat_TagConsentTitle');
                $field->description = Piwik::translate('Hazelchat_TagConsentDescription');
            }),
        );
    }
}
