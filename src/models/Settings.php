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
 * Lightkeeper Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Kyle Andrews
 * @package   Lightkeeper
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /** @var string */
    public ?string $developerEmail = null;

    /** @var int */
    public int $minimumPerformance = 90;

    /** @var int */
    public int $minimumAccessibility = 100;

    /** @var int */
    public int $minimumBestPractices = 100;

    /** @var int */
    public int $minimumSeo = 100;

    /** @var int */
    public int $lcpThreshold = 2500;

    /** @var int */
    public int $fidThreshold = 100;

    /** @var float */
    public float $clsThreshold = 0.1;

    /** @var int */
    public int $fcpThreshold = 2000;

    /** @var int */
    public int $ttfbThreshold = 600;

    /** @var bool */
    public bool $advancedSettings = false;

    /** @var bool */
    public bool $anonymous = false;

    /** @var bool */
    public bool $compact = false;

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            [['minimumPerformance', 'minimumAccessibility', 'minimumBestPractices', 'minimumSeo', 'lcpThreshold', 'fidThreshold', 'clsThreshold', 'fcpThreshold', 'ttfbThreshold'], 'required'],
            [['minimumPerformance', 'minimumAccessibility', 'minimumBestPractices', 'minimumSeo', 'lcpThreshold', 'fidThreshold', 'fcpThreshold', 'ttfbThreshold', 'advancedSettings'], 'number', 'integerOnly' => true],
            
            [['clsThreshold'], 'number'],
            [['clsThreshold'], 'default', 'value' => 0.1],
            [['lcpThreshold'], 'default', 'value' => 2500],
            [['fidThreshold'], 'default', 'value' => 100],
            [['fcpThreshold'], 'default', 'value' => 2000],
            [['ttfbThreshold'], 'default', 'value' => 600],

            [['minimumAccessibility', 'minimumBestPractices', 'minimumSeo'], 'default', 'value' => 100],
            [['minimumPerformance'], 'default', 'value' => 90],

            [['advancedSettings', 'anonymous', 'compact'], 'boolean'],
            [['advancedSettings', 'anonymous', 'compact'], 'default', 'value' => false],

            [['developerEmail'], 'email'],
            [['developerEmail'], 'default', 'value' => null],
        ];
    }
}
