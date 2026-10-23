<?php

/**
 * Hazelchat for Matomo.
 *
 * @link https://hazelchat.co/integrations/matomo/
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\Hazelchat;

/**
 * The website's public Hazelchat key from what an owner pastes: the
 * 64-character key itself, or the installation code Hazelchat shows, from
 * which only its one data-agent value is kept. Anything else is no key.
 * The same rules as the WordPress, Joomla and TYPO3 extensions.
 */
class Key
{
    /**
     * @param mixed $value
     * @return string|null
     */
    public static function fromInput($value)
    {
        if (!is_string($value)) {
            return null;
        }
        $value = trim($value);
        if (preg_match('/^[a-f0-9]{64}$/', $value)) {
            return $value;
        }
        if (strlen($value) > 1000) {
            return null;
        }
        // Only Hazelchat's own installation code: one script element for
        // the widget address, carrying exactly one data-agent value.
        if (!preg_match('#^<script\b[^>]*\bsrc=(["\'])https://app\.hazelchat\.co/widget\.js\1[^>]*>\s*</script>$#i', $value)) {
            return null;
        }
        if (preg_match_all('/\sdata-agent\s*=\s*(["\']?)([^"\'\s>]*)\1/i', $value, $found) !== 1) {
            return null;
        }
        $key = $found[2][0];
        return preg_match('/^[a-f0-9]{64}$/', $key) ? $key : null;
    }
}
