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

class ArcMemberGrade extends Model
{
    public $quizEntryId;

    public $discordUsername;

    public $discordEmail;

    public $quizScore;

    public $quizAnswers;

    public $questions;

    public function __construct($obj = null, $config = [])
    {
        if($obj != null)
        {
            if(method_exists($obj, 'getBodyParam'))
            {
                $this->quizEntryId = $obj->getBodyParam('quizEntryId');
                $this->discordEmail = $obj->getBodyParam('discordEmail');
                $this->discordUsername = $obj->getBodyParam('discordUsername');
                $this->questions = $obj->getBodyParam('questions');
            }
            else
            {
                $this->quizEntryId = $obj->quizEntryId;
                $this->discordEmail = $obj->discordEmail;
                $this->discordUsername = $obj->discordUsername;
                $this->questions = $obj->questions;
            }
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
            ['discordUsername', 'discordEmail', 'quizAnswers'],
            'string',
        ];

        return $rules;
    }
}
