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
    public static function tableName()
    {
        return '{{%web_vitals}}';
    }

    public function rules()
    {
        return [
            [['id', 'cls', 'fid', 'lcp', 'browser', 'screenSize', 'threads', 'ram', 'connection', 'storage'], 'required'],
            [['browser', 'screenSize', 'connection'], 'string'],
            [['id', 'cls', 'fid', 'lcp', 'threads', 'ram', 'storage'], 'number'],
        ];
    }
}