<?php
/**
 * Lightkeeper plugin for Craft CMS 3.x
 *
 * Lightkeeper helps to integrate and automate Google Lighthouse testing.
 *
 * @link      https://kyleandrews.dev/
 * @copyright Copyright (c) 2020 Kyle Andrews
 */

namespace codewithkyle\lightkeeper\records;

use codewithkyle\lightkeeper\Lightkeeper;

use Craft;
use craft\db\ActiveRecord;

class LighthouseReportRecord extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%lighthouse_reports}}';
    }

    public function rules()
    {
        return [
            [['pageId', 'performance', 'accessibility', 'bestPractices', 'seo'], 'required'],
            [['id', 'pageId', 'performance', 'accessibility', 'bestPractices', 'seo'], 'number'],
        ];
    }
}