<?php
/**
 * ARC plugin for Craft CMS 3.x
 *
 * Custom Plugin for ARCollective Website
 *
 * @link      https://realitygems.com
 * @copyright Copyright (c) 2022 RealityGems
 */

namespace realitygems\arc\records;

use realitygems\arc\ARC;
use Craft;
use craft\db\ActiveRecord;

class ArcMemberGradeRecord extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%arc_member_grade}}';
    }
}
