<?php
/**
 * ARC plugin for Craft CMS 3.x
 *
 * Custom Plugin for ARCollective Website
 *
 * @link      https://realitygems.com
 * @copyright Copyright (c) 2022 RealityGems
 */

namespace realitygems\arc\utilities;

use realitygems\arc\ARC;
use realitygems\arc\assetbundles\arcutilityutility\ARCUtilityUtilityAsset;

use Craft;
use craft\base\Utility;

/**
 * ARC Utility
 *
 * Utility is the base class for classes representing Control Panel utilities.
 *
 * https://craftcms.com/docs/plugins/utilities
 *
 * @author    RealityGems
 * @package   ARC
 * @since     1.0.0
 */
class ARCUtility extends Utility
{
    // Static
    // =========================================================================

    /**
     * Returns the display name of this utility.
     *
     * @return string The display name of this utility.
     */
    public static function displayName(): string
    {
        return Craft::t('arc', 'ARCUtility');
    }

    /**
     * Returns the utility’s unique identifier.
     *
     * The ID should be in `kebab-case`, as it will be visible in the URL (`admin/utilities/the-handle`).
     *
     * @return string
     */
    public static function id(): string
    {
        return 'arc-a-r-c-utility';
    }

    /**
     * Returns the path to the utility's SVG icon.
     *
     * @return string|null The path to the utility SVG icon
     */
    public static function iconPath()
    {
        return Craft::getAlias("@realitygems/arc/assetbundles/arcutilityutility/dist/img/ARCUtility-icon.svg");
    }

    /**
     * Returns the number that should be shown in the utility’s nav item badge.
     *
     * If `0` is returned, no badge will be shown
     *
     * @return int
     */
    public static function badgeCount(): int
    {
        return 0;
    }

    /**
     * Returns the utility's content HTML.
     *
     * @return string
     */
    public static function contentHtml(): string
    {
        Craft::$app->getView()->registerAssetBundle(ARCUtilityUtilityAsset::class);

        $someVar = 'Have a nice day!';
        return Craft::$app->getView()->renderTemplate(
            'arc/_components/utilities/ARCUtility_content',
            [
                'someVar' => $someVar
            ]
        );
    }
}
