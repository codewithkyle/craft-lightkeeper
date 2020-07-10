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
use craft\web\Controller;
use codewithkyle\lightkeeper\services\LightkeeperService;

class DefaultController extends Controller
{
    protected $allowAnonymous = [
        'report'
    ];

    public function actionReport()
    {
        $this->requirePostRequest();
        $request = Craft::$app->getRequest();
        Lightkeeper::getInstance()->lightkeeperService->logReport($request->getBodyParams());
    }
}