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

    public function logReport(Array $params, String $ip)
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
        $report->url = $params['url'];
        $report->ip = $ip;

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

    public function getReports($page = 0)
    {
        $offset = 25 * $page;
        $rows = Report::find()
                        ->offset($offset)
                        ->limit(26)
                        ->orderBy(['dateCreated' => SORT_DESC])
                        ->all();
        $reports = array();
        $helper = new \craft\helpers\DateTimeHelper();
        foreach ($rows as $report){
            $reports[] = [
                'id' => $report->id,
                'cls' => round($report->cls, 3),
                'fcp' => round($report->fcp, 2),
                'lcp' => round($report->lcp, 2),
                'fid' => round($report->fid, 2),
                'ttfb' => round($report->ttfb, 2),
                'dateCreated' => date_format($helper->toDateTime($report->dateCreated), 'm/d/Y g:ia'),
                'browser' => $report->browser . ' v' . $report->browserVersion,
                'os' => $report->os,
                'screen' => $report->screenWidth . 'x' . $report->screenHeight,
                'threads' => $report->threads ?? 'unknown',
                'ram' => $report->ram ?? 'unknown',
                'connection' => $report->connection ?? 'unknown',
                'storage' => $report->storage ?? 'unknown',
                'ip' => $report->ip,
                'url' => $report->url,
            ];
        }
        return $reports;
    }
}
