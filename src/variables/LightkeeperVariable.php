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
    public function load(): void
    {
        $view = Craft::$app->getView();
        $view->registerAssetBundle('codewithkyle\\lightkeeper\\assetbundles\\lightkeeper\\LightkeeperAsset');
    }

    public function getReports($page = 0): array
    {
        return Lightkeeper::getInstance()->lightkeeperService->getWebVitalReports($page);
    }

    public function checkCLS(float $value): string
    {
        $threshold = Lightkeeper::getInstance()->getSettings()->clsThreshold;
        if ($value <= $threshold)
        {
            return 'pass';
        }
        else if ($value > $threshold && $value <= $threshold * 2)
        {
            return 'warn';
        }
        else
        {
            return 'fail';
        }
    }

    public function checkFCP(float $value): string
    {
        $threshold = Lightkeeper::getInstance()->getSettings()->fcpThreshold;
        if ($value <= $threshold)
        {
            return 'pass';
        }
        else if ($value > $threshold && $value <= $threshold * 2)
        {
            return 'warn';
        }
        else
        {
            return 'fail';
        }
    }

    public function checkLCP(float $value): string
    {
        $threshold = Lightkeeper::getInstance()->getSettings()->lcpThreshold;
        if ($value <= $threshold)
        {
            return 'pass';
        }
        else if ($value > $threshold && $value <= $threshold * 2)
        {
            return 'warn';
        }
        else
        {
            return 'fail';
        }
    }

    public function checkFID(float $value): string
    {
        $threshold = Lightkeeper::getInstance()->getSettings()->fidThreshold;
        if ($value <= $threshold)
        {
            return 'pass';
        }
        else if ($value > $threshold && $value <= $threshold * 2)
        {
            return 'warn';
        }
        else
        {
            return 'fail';
        }
    }

    public function checkTTFB(float $value): string
    {
        $threshold = Lightkeeper::getInstance()->getSettings()->ttfbThreshold;
        if ($value <= $threshold)
        {
            return 'pass';
        }
        else if ($value > $threshold && $value <= $threshold * 2)
        {
            return 'warn';
        }
        else
        {
            return 'fail';
        }
    }

    public function getLighthouseReport(int $pageId): \codewithkyle\lightkeeper\records\LighthouseReportRecord
    {
        return Lightkeeper::getInstance()->lightkeeperService->getLighthouseReport($pageId);
    }
}