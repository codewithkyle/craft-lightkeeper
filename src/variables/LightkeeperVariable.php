<?php
/**
 * Lightkeeper plugin for Craft CMS 3.x
 *
 * Lightkeeper helps to integrate and automate Google Lighthouse testing.
 *
 * @link      https://kyleandrews.dev/
 * @copyright Copyright (c) 2020 Kyle Andrews
 */

namespace codewithkyle\lightkeeper\variables;

use codewithkyle\lightkeeper\Lightkeeper;

use Craft;

class LightkeeperVariable
{
    public function loadWebVitals()
    {
        $view = Craft::$app->getView();
        $view->registerAssetBundle('codewithkyle\\lightkeeper\\assetbundles\\lightkeeper\\LightkeeperAsset');
    }
}