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
use codewithkyle\lightkeeper\records\WebVitalReportRecord as WebVitalReport;
use craft\helpers\UrlHelper;
use craft\elements\Entry;
use craft\elements\Category;
use codewithkyle\lightkeeper\records\LighthouseReportRecord as LighthouseReport;

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

    public function logWebVitalReport(Array $params, String $ip)
    {
        $report = new WebVitalReport();
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
        
        $settings = Lightkeeper::getInstance()->getSettings();
        if (isset($params['uuid']))
        {
            $report->ip = $params['uuid'];
        }
        else if (!$settings->anonymous)
        {
            $report->ip = $ip;
        }
        else
        {
            $report->ip = null;
        }

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

    public function getWebVitalReports($page = 0)
    {
        $offset = 25 * $page;
        $rows = WebVitalReport::find()
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

    public function renderEntryTemplate($entryContext)
    {
        $entry = Entry::find()->id($entryContext->id)->one();
        $ret = null;
        if (isset($entry->url)){
            $ret = Craft::$app->getView()->renderTemplate('lightkeeper/lightkeeper.twig', [
                'url' => $entry->url,
                'id' => $entry->id,
            ]);
        }
        return $ret;
    }
    public function renderCategoryTemplate($categoryContext)
    {
        $category = Category::find()->id($categoryContext->id)->one();
        $ret = null;
        if (isset($category->url)){
            $ret = Craft::$app->getView()->renderTemplate('lightkeeper/lightkeeper.twig', [
                'url' => $category->url,
                'id' => $category->id,
            ]);
        }
        return $ret;
    }

    public function getLighthouseReport(int $pageId)
    {
        $report = LighthouseReport::find()
                    ->where(['pageId' => $pageId])
                    ->one();
        return $report;
    }

    public function logLighthouseReport(Array $params)
    {
        $report = null;
        $newRecord = false;
        $res = [
            'success' => true,
            'errors' => null,
        ];

        if (isset($params['reportId']))
        {
            $report = LighthouseReport::find()->where(['id' => $params['reportId']])->one();
            if (is_null($report))
            {
                $report = new LighthouseReport();
                $report->setIsNewRecord(true);
                $newRecord = true;
            }
            else
            {
                $report->setIsNewRecord(false);
            }
        }
        else
        {
            $report = new LighthouseReport();
            $report->setIsNewRecord(true);
            $newRecord = true;
        }

        $report->pageId = $params['pageId'];
        $report->performance = $params['performance'];
        $report->accessibility = $params['accessibility'];
        $report->bestPractices = $params['bestPractices'];
        $report->seo = $params['seo'];

        if ($report->validate())
        {
            $report->save();
            if ($newRecord)
            {
                $newReport = LighthouseReport::find()->where(['pageId' => $params['pageId']])->one();
                $res['reportId'] = $newReport->id;
            }
        }
        else
        {
            $res['success'] = false;
            $res['errors'] = $report->errors;
        }

        // Email notification
        $settings = Lightkeeper::getInstance()->getSettings();
        if (isset($settings['developerEmail']))
        {
            $passedPerformance = true;
            $passedAccessibility = true;
            $passedBestPractices = true;
            if ($params['performance'] * 100 < $settings['minimumPerformance'])
            {
                $passedPerformance = false;
            }
            if ($params['accessibility'] * 100 < $settings['minimumAccessibility'])
            {
                $passedAccessibility = false;
            }
            if ($params['bestPractices'] * 100 < $settings['minimumBestPractices'])
            {
                $passedBestPractices = false;
            }

            // Do we need to send an email?
            if (!empty($settings['developerEmail']))
            {
                if (!$passedAccessibility || !$passedBestPractices || !$passedPerformance)
                {
                    $html = '
                        The page <a href="' . $params['url'] . '" target="_blank">' . $params['url'] . '</a> has failed a Lighthouse audit:<br/>
                        <strong>Performance:</strong> ' . $params['performance'] * 100 . '/' . $settings['minimumPerformance'] . '<br/>
                        <strong>Accessibility:</strong> ' . $params['accessibility'] * 100 . '/' . $settings['minimumAccessibility'] . '<br/>
                        <strong>Best Practices:</strong> ' . $params['bestPractices'] * 100 . '/' . $settings['minimumBestPractices'];
                    $this->sendMail($html, Craft::$app->getSystemName() . ' - Lighthouse Audit Failed', $settings['developerEmail']);
                }
            }
        }

        return $res;
    }

    public function sendMail(string $html, string $subject, $mail): bool
    {
        return Craft::$app
            ->getMailer()
            ->compose()
            ->setTo($mail)
            ->setSubject($subject)
            ->setHtmlBody($html)
            ->send();
    }
}
