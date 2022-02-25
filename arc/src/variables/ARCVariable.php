<?php
/**
 * ARC plugin for Craft CMS 3.x
 *
 * Custom Plugin for ARCollective Website
 *
 * @link      https://realitygems.com
 * @copyright Copyright (c) 2022 RealityGems
 */

namespace realitygems\arc\variables;

use realitygems\arc\ARC;
use Craft;

class ArcVariable
{
    public function isUserLoggedIn()
    {
        return Craft::$app->getSession()->get('isLoggedIn');
    }
}
