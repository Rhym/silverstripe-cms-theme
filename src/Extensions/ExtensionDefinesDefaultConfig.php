<?php

namespace RyanPotter\SilverstripeCMSTheme\Extensions;

use SilverStripe\Core\Config\Config;

/**
 * Config settings defined by extensions that have values (either in private static variables or YAML) will
 * override those same settings on extended classes - even if the desired behaviour is to provide a default on the
 * extension and the extended class should override these. This trait allows that behaviour to be restored.
 * https://github.com/silverstripe/silverstripe-framework/issues/7970
 *
 * The class using this trait should define a const called CONFIG_SETTINGS_WITH_DEFAULTS which is an array of strings.
 * Each string should be the name of a config setting (i.e. the name of a private static variable).
 *
 * @package RyanPotter\SilverstripeCMSTheme\Extensions
 * @mixin \SilverStripe\Core\Extension
 */
trait ExtensionDefinesDefaultConfig
{
    /**
     * Generate extra config for a class, letting it override the concrete extension's config settings.
     * @param $class
     * @return array
     */
    public static function get_extra_config($class)
    {
        $config = Config::inst();
        $classConfig = $config->get($class, null, Config::EXCLUDE_EXTRA_SOURCES);
        $extensionConfig = $config->get(static::class);
        $extraConfig = [];

        foreach (static::CONFIG_SETTINGS_WITH_DEFAULTS as $setting) {
            if (isset($classConfig[$setting]) && !is_array($extensionConfig[$setting])) {
                $extraConfig[$setting] = $classConfig[$setting];
            } else {
                $extraConfig[$setting] = $extensionConfig[$setting];
            }
        }

        return $extraConfig;
    }
}