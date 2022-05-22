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
 * Class LighthouseReport
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
class LighthouseReport extends Model
{
    /** @var int */
    public int $id;

    /** @var int */
    public int $pageId;

    /** @var float */
    public float $performance;

    /** @var float */
    public float $accessibility;

    /** @var float */
    public float $bestPractices;

    /** @var float */
    public float $seo;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [
                ['id', 'pageId'], 'number', 'integerOnly' => true,
            ],
        ];
    }
}