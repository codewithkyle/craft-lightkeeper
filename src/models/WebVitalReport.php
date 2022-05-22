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
 * Class WebVitalReport
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
class WebVitalReport extends Model
{
    /** @var int */
    public int $id;

    /** @var float */
    public float $cls;

    /** @var float */
    public float $fid;

    /** @var float */
    public float $fcp;

    /** @var float */
    public float $ttfb;

    /** @var float */
    public float $lcp;

    /** @var string */
    public string $browser;

    /** @var string */
    public string $browserVersion;

    /** @var string */
    public string $os;

    /** @var int */
    public int $screenWidth;

    /** @var int */
    public int $screenHeight;

    /** @var int */
    public int $threads;

    /** @var int */
    public int $ram;

    /** @var string */
    public string $connection;

    /** @var float */
    public float $storage;

    /** @var string */
    public string $ip;

    /** @var string */
    public string $url;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [
                ['id', 'threads', 'ram'], 'number', 'integerOnly' => true,
            ],
        ];
    }
}