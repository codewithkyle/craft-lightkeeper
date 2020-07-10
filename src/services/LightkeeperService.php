<?php
/**
 * Lightkeeper plugin for Craft CMS 3.x
 *
 * Lightkeeper helps to integrate and automate Google Lighthouse testing.
 *
 * @link      https://kyleandrews.dev/
 * @copyright Copyright (c) 2020 Kyle Andrews
 */

namespace codewithkyle\lightkeeper\services;

use codewithkyle\lightkeeper\Lightkeeper;

use Craft;
use craft\base\Component;

/**
 * LightkeeperService Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Kyle Andrews
 * @package   Lightkeeper
 * @since     1.0.0
 */
class LightkeeperService extends Component
{
    // Public Methods
    // =========================================================================

    public function logReport(Array $params)
    {
        
    }
}
