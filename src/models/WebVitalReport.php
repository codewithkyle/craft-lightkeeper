<?php
/**
 * Lightkeeper plugin for Craft CMS 3.x
 *
 * Lightkeeper helps to integrate and automate Google Lighthouse testing.
 *
 * @link      https://kyleandrews.dev/
 * @copyright Copyright (c) 2020 Kyle Andrews
 */

namespace codewithkyle\lightkeeper\models;

use codewithkyle\lightkeeper\Lightkeeper;

use Craft;
use craft\base\Model;

/**
 * Class WebVitalReportModel
 * 
 * @property int    $id
 * @property float  $cls
 * @property float  $fid
 * @property float  $lcp
 * @property string $browser
 * @property string $screenSize
 * @property int    $threads
 * @property int    $ram
 * @property string $connection
 * @property float  $storage
 */
class WebVitalReportModel extends Model
{
    /** @var init */
    public $id;

    /** @var float */
    public $cls;

    /** @var float */
    public $fid;

    /** @var float */
    public $fcp;

    /** @var float */
    public $ttfb;

    /** @var float */
    public $lcp;

    /** @var string */
    public $browser;

    /** @var string */
    public $browserVersion;

    /** @var string */
    public $os;

    /** @var int */
    public $screenWidth;

    /** @var int */
    public $screenHeight;

    /** @var int */
    public $threads;

    /** @var int */
    public $ram;

    /** @var string */
    public $connection;

    /** @var float */
    public $storage;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [
                ['id', 'threads', 'ram'], 'number', 'integerOnly' => true,
            ],
        ];
    }
}