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

use Craft;
use realitygems\arc\ARC;

class ArcVariable
{
    public function isUserLoggedIn()
    {
        return Craft::$app->getSession()->get('isLoggedIn');
    }

    public function getArcMember()
    {
        $service = ARC::$plugin->arcService;
        
        return $service->getArcMemberFromApi();
    }
}
