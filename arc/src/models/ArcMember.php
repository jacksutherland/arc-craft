<?php
/**
 * ARC plugin for Craft CMS 3.x
 *
 * Custom Plugin for ARCollective Website
 *
 * @link      https://realitygems.com
 * @copyright Copyright (c) 2022 RealityGems
 */

namespace realitygems\arc\models;

use realitygems\arc\ARC;
use Craft;
use craft\base\Model;

class ArcMember extends Model
{
    public $discordId;

    public $discordUsername;

    public $discordEmail;

    public function __construct($obj = null, $config = [])
    {
        if($obj != null)
        {
            $this->discordId = $obj->discordId;
            $this->discordUsername = $obj->discordUsername;
            $this->discordEmail = $obj->discordEmail;
        }

        parent::__construct($config);
    }

    public function rules()
    {
        // return [
        //     ['someAttribute', 'string'],
        //     ['someAttribute', 'default', 'value' => 'Some Default'],
        // ];

        $rules = parent::defineRules();

        // $rules[] = [
        //     ['eventDate'], 
        //     DateTimeValidator::class
        // ];

        // $rules[] = [
        //     ['assetId', 'entryId'], 
        //     'number', 'integerOnly' => true
        // ];

        // $rules[] = [
        //     ['enabled'],
        //     'boolean',
        // ];

        // $rules[] = [
        //     ['discordId'], 
        //     'number', 'integerOnly' => true
        // ];

        $rules[] = [
            ['discordId', 'discordUsername', 'discordEmail'],
            'string',
        ];

        return $rules;
    }
}
