<?php
/**
 * ARC plugin for Craft CMS 3.x
 *
 * Custom Plugin for ARCollective Website
 *
 * @link      https://realitygems.com
 * @copyright Copyright (c) 2022 RealityGems
 */

namespace realitygems\arc\migrations;

use realitygems\arc\ARC;
use Craft;
use craft\config\DbConfig;
use craft\db\Migration;

class Install extends Migration
{
    public $driver;

    public function safeUp()
    {
        $this->driver = Craft::$app->getConfig()->getDb()->driver;
        if ($this->createTables()) {
            $this->createIndexes();
            $this->addForeignKeys();
            // Refresh the db schema caches
            Craft::$app->db->schema->refresh();
            $this->insertDefaultData();
        }

        return true;
    }

    public function safeDown()
    {
        $this->driver = Craft::$app->getConfig()->getDb()->driver;
        $this->removeTables();

        return true;
    }


    protected function createTables()
    {
        $tablesCreated = false;

        // arc_member table
        $tableSchema = Craft::$app->db->schema->getTableSchema('{{%arc_member}}');
        if ($tableSchema === null) {
            $tablesCreated = true;
            $this->createTable(
                '{{%arc_member}}',
                [
                    'id' => $this->primaryKey(),
                    'dateCreated' => $this->dateTime()->notNull(),
                    'dateUpdated' => $this->dateTime()->notNull(),
                    'uid' => $this->uid(),
                    'siteId' => $this->integer()->notNull(),
                    //'discordId' => $this->integer()->notNull(),
                    'discordId' => $this->string(255)->notNull()->defaultValue(''),
                    'discordUsername' => $this->string(255)->notNull()->defaultValue(''),
                    'discordEmail' => $this->string(255)->notNull()->defaultValue(''),
                ]
            );
        }

        return $tablesCreated;
    }


    protected function createIndexes()
    {
        // arc_member table
        $this->createIndex(
            $this->db->getIndexName(
                '{{%arc_member}}',
                'some_field',
                true
            ),
            '{{%arc_member}}',
            'some_field',
            true
        );
        // Additional commands depending on the db driver
        switch ($this->driver) {
            case DbConfig::DRIVER_MYSQL:
                break;
            case DbConfig::DRIVER_PGSQL:
                break;
        }
    }

    protected function addForeignKeys()
    {
        // arc_member table
        $this->addForeignKey(
            $this->db->getForeignKeyName('{{%arc_member}}', 'siteId'),
            '{{%arc_member}}',
            'siteId',
            '{{%sites}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    protected function insertDefaultData()
    {
    }


    protected function removeTables()
    {
        // arc_member table
        $this->dropTableIfExists('{{%arc_member}}');
    }
}
