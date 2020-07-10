<?php
/**
 * Lightkeeper plugin for Craft CMS 3.x
 *
 * Lightkeeper helps to integrate and automate Google Lighthouse testing.
 *
 * @link      https://kyleandrews.dev/
 * @copyright Copyright (c) 2020 Kyle Andrews
 */

namespace codewithkyle\lightkeeper\migrations;

use codewithkyle\lightkeeper\Lightkeeper;

use Craft;
use craft\config\DbConfig;
use craft\db\Migration;

class Install extends Migration
{
    /** @var string */
    public $driver;

    public function safeUp()
    {
        $this->driver = Craft::$app->getConfig()->getDb()->driver;
        if ($this->createTables())
        {
            $this->createIndexes();
            Craft::$app->db->schema->refresh();
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

        $tableSchema = Craft::$app->db->schema->getTableSchema('{{%web_vitals}}');
        if ($tableSchema === null)
        {
            $tablesCreated = true;
            $this->createTable(
                '{{%web_vitals}}',
                [
                    'id' => $this->primaryKey(),
                    'cls' => $this->double()->notNull(),
                    'fid' => $this->double()->notNull(),
                    'lcp' => $this->double()->notNull(),
                    'browser' => $this->string(255)->notNull(),
                    'screenSize' => $this->string(255)->notNull(),
                    'threads' => $this->integer()->notNull(),
                    'ram' => $this->integer()->notNull(),
                    'connection' => $this->string(255)->notNull(),
                    'storage' => $this->double()->notNull(),
                    'dateCreated' => $this->dateTime()->notNull(),
                    'dateUpdated' => $this->dateTime()->notNull(),
                    'uid' => $this->uid(),
                ]
            );

            return $tablesCreated;
        }
    }

    protected function createIndexes()
    {
        $this->createIndex(
            $this->db->getIndexName(
                '{{%web_vitals}}',
                ['id', 'cls', 'fid', 'lcp', 'browser', 'screenSize', 'threads', 'ram', 'connection', 'storage'],
                true,  
            ),
            '{{%web_vitals}}',
            ['id', 'cls', 'fid', 'lcp', 'browser', 'screenSize', 'threads', 'ram', 'connection', 'storage', 'dateCreated', 'dateUpdated', 'uid'],
            true
        );
    }

    protected function removeTables()
    {
        $this->dropTableIfExists('{{%web_vitals}}');
    }
}