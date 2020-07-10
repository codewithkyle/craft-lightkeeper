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
    public $developerEmail = '';

    /** @var int */
    public $minimumPerformance = '90';

    /** @var int */
    public $minimumAccessibility = '100';

    /** @var int */
    public $minimumBestPractices = '100';

    /** @var int */
    public $minimumSeo = '100';

    /** @var int */
    public $lcpThreshold = 2500;

    /** @var int */
    public $fidThreshold = 100;

    /** @var float */
    public $clsThreshold = 0.1;

    /** @var int */
    public $fcpThreshold = 2000;

    /** @var int */
    public $ttfbThreshold = 600;

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
    public function rules()
    {
        return [
            [['minimumPerformance', 'minimumAccessibility', 'minimumBestPractices', 'minimumSeo'], 'required'],
            ['developerEmail', 'string'],
            [['minimumPerformance', 'minimumAccessibility', 'minimumBestPractices', 'minimumSeo'], 'number', 'integerOnly' => true],
            [['minimumAccessibility', 'minimumBestPractices', 'minimumSeo'], 'default', 'value' => 100],
            [['minimumPerformance'], 'default', 'value' => 90],
        ];
    }
}
