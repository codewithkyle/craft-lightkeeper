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

class WebVitalReportRecord extends ActiveRecord
{
    public static function tableName(): string 
    {
        return '{{%lightkeeper_web_vitals}}';
    }

    public function rules(): array
    {
        return [
            [['cls', 'fid', 'fcp', 'ttfb', 'lcp', 'browser', 'browserVersion', 'screenWidth', 'screenHeight', 'os', 'ip', 'url'], 'required'],
            [['browser', 'browserVersion', 'connection', 'os', 'ip', 'url'], 'string'],
            [['id', 'cls', 'fid', 'lcp', 'fcp', 'ttfb', 'threads', 'ram', 'storage', 'screenWidth', 'screenHeight'], 'number'],
        ];
    }
}