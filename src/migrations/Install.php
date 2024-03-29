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
    public function safeUp(): bool
    {
        if ($this->createTables())
        {
            $this->createIndexes();
            Craft::$app->db->schema->refresh();
        }

        return true;
    }

    public function safeDown(): bool
    {
        $this->removeTables();
        return true;
    }

    protected function createTables(): bool
    {
        $tablesCreated = true;

        $vitalsTable = Craft::$app->db->schema->getTableSchema('{{%lightkeeper_web_vitals}}');
        if (is_null($vitalsTable))
        {
            $this->createTable(
                '{{%lightkeeper_web_vitals}}',
                [
                    'id' => $this->primaryKey(),
                    'cls' => $this->double()->notNull(),
                    'fid' => $this->double()->notNull(),
                    'lcp' => $this->double()->notNull(),
                    'fcp' => $this->double()->notNull(),
                    'ttfb' => $this->double()->notNull(),
                    'os' => $this->string(255)->notNull(),
                    'browser' => $this->string(255)->notNull(),
                    'browserVersion' => $this->string(255)->notNull(),
                    'screenWidth' => $this->integer()->notNull(),
                    'screenHeight' => $this->integer()->notNull(),
                    'threads' => $this->integer(),
                    'ram' => $this->integer(),
                    'connection' => $this->string(255),
                    'storage' => $this->double(),
                    'ip' => $this->string(255)->notNull(),
                    'url' => $this->string(255)->notNull(),
                    'dateCreated' => $this->dateTime()->notNull(),
                    'dateUpdated' => $this->dateTime()->notNull(),
                    'uid' => $this->uid(),
                ]
            );
        }
        else
        {
            $tablesCreated = false;
        }

        $lighthouseTable = Craft::$app->db->schema->getTableSchema('{{%lightkeeper_lighthouse_reports}}');
        if (is_null($lighthouseTable))
        {
            $this->createTable(
                '{{%lightkeeper_lighthouse_reports}}',
                [
                    'id' => $this->primaryKey(),
                    'pageId' => $this->integer()->notNull(),
                    'performance' => $this->double()->notNull(),
                    'accessibility' => $this->double()->notNull(),
                    'bestPractices' => $this->double()->notNull(),
                    'seo' => $this->double()->notNull(),
                    'dateCreated' => $this->dateTime()->notNull(),
                    'dateUpdated' => $this->dateTime()->notNull(),
                    'uid' => $this->uid(),
                ]
            );
        }
        else
        {
            $tablesCreated = false;
        }

        return $tablesCreated;
    }

    protected function createIndexes(): void
    {
        $this->createIndex(
            $this->db->getIndexName(
                '{{%lightkeeper_lighthouse_reports}}',
                'id',
                true
            ),
            '{{%lightkeeper_lighthouse_reports}}',
            'id',
            true
        );
        $this->createIndex(
            $this->db->getIndexName(
                '{{%lightkeeper_lighthouse_reports}}',
                'pageId',
                true
            ),
            '{{%lightkeeper_lighthouse_reports}}',
            'pageId',
            true
        );
    }

    protected function removeTables(): void
    {
        $this->dropTableIfExists('{{%lightkeeper_web_vitals}}');
        $this->dropTableIfExists('{{%lightkeeper_lighthouse_reports}}');
    }
}