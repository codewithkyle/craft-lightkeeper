<?php
/**
 * Lightkeeper plugin for Craft CMS 3.x
 *
 * Lightkeeper helps to integrate and automate Google Lighthouse testing.
 *
 * @link      https://kyleandrews.dev/
 * @copyright Copyright (c) 2020 Kyle Andrews
 */

namespace codewithkyle\lightkeeper;

use codewithkyle\lightkeeper\services\LightkeeperService as LightkeeperServiceService;
use codewithkyle\lightkeeper\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\events\RegisterCpNavItemsEvent;
use craft\web\twig\variables\Cp;
use craft\web\twig\variables\CraftVariable;
use codewithkyle\lightkeeper\variables\LightkeeperVariable;

use yii\base\Event;

/**
 * Craft plugins are very much like little applications in and of themselves. We’ve made
 * it as simple as we can, but the training wheels are off. A little prior knowledge is
 * going to be required to write a plugin.
 *
 * For the purposes of the plugin docs, we’re going to assume that you know PHP and SQL,
 * as well as some semi-advanced concepts like object-oriented programming and PHP namespaces.
 *
 * https://docs.craftcms.com/v3/extend/
 *
 * @author    Kyle Andrews
 * @package   Lightkeeper
 * @since     1.0.0
 *
 * @property  LightkeeperServiceService $lightkeeperService
 * @property  Settings $settings
 * @method    Settings getSettings()
 */
class Lightkeeper extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * Static property that is an instance of this plugin class so that it can be accessed via
     * Lightkeeper::$plugin
     *
     * @var Lightkeeper
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * To execute your plugin’s migrations, you’ll need to increase its schema version.
     *
     * @var string
     */
    public $schemaVersion = '1.0.0';

    /**
     * Set to `true` if the plugin should have a settings view in the control panel.
     *
     * @var bool
     */
    public $hasCpSettings = true;

    /**
     * Set to `true` if the plugin should have its own section (main nav item) in the control panel.
     *
     * @var bool
     */
    public $hasCpSection = false;

    // Public Methods
    // =========================================================================

    public function init()
    {
        Craft::setAlias('@lightkeeper', __DIR__);
        parent::init();
        self::$plugin = $this;

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event)
            {
                $variable = $event->sender;
                $variable->set('lightkeeper', LightkeeperVariable::class);
            }
        );

        Event::on(
            Cp::class,
            Cp::EVENT_REGISTER_CP_NAV_ITEMS,
            function(RegisterCpNavItemsEvent $event)
            {
                $event->navItems[] = [
                    'url' => 'lightkeeper/web-vitals',
                    'label' => 'Performance Audits',
                    'icon' => '@lightkeeper/assetbundles/lightkeeper/dist/img/lightkeeper-icon.svg',
                ];
            }
        );

        Craft::info(
            Craft::t(
                'lightkeeper',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * Creates and returns the model used to store the plugin’s settings.
     *
     * @return \craft\base\Model|null
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * Returns the rendered settings HTML, which will be inserted into the content
     * block on the settings page.
     *
     * @return string The rendered settings HTML
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'lightkeeper/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
