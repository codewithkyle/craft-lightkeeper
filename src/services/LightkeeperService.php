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
use codewithkyle\lightkeeper\records\WebVitalReportRecord as Report;

/**
 * LightkeeperService Service
 *
 * @author    Kyle Andrews
 * @package   Lightkeeper
 * @since     1.0.0
 */
class LightkeeperService extends Component
{
    // Public Methods
    // =========================================================================

    public function logReport($params)
    {
        $report = new Report();
        $report->setIsNewRecord(true);

        // General info
        $report->connection = $params['connection'];
        $report->ram = $params['ram'];
        $report->threads = $params['cpu'];
        $report->screenWidth = $params['screenWidth'];
        $report->screenHeight = $params['screenHeight'];
        $report->browser = $params['browser'];
        $report->browserVersion = $params['browserVersion'];
        $report->os = $params['os'];
        $report->storage = $params['storage'];

        // Audits
        $report->cls = $params['cls'];
        $report->fid = $params['fid'];
        $report->fcp = $params['fcp'];
        $report->ttfb = $params['ttfb'];
        $report->lcp = $params['lcp'];

        if ($report->validate())
        {
            $report->save();
        }
    }
}
