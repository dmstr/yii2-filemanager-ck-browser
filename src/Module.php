<?php

namespace dmstr\filemanagerCkBrowser;

use dmstr\auditAddons\assets\AuditAddonAsset;
use dmstr\auditAddons\commands\TranslationUpdateReportController;
use dmstr\web\traits\AccessBehaviorTrait;
use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;

/**
 * Class Module
 * @package dmstr\filemanagerCkBrowser
 */
class Module extends \yii\base\Module
{
    use AccessBehaviorTrait;

    /**
     * layout that should be used for the fileBrowser view
     *
     * @var string
     */
    public $fileBrowserLayout = '@vendor/dmstr/yii2-filefly-module/views/layouts/plain';

    /**
     * handlerUrl for the fileBrowser widget
     * @see: \hrzg\filemanager\widgets\FileManagerWidget::$handlerUrl
     *
     * @var string
     */
    public $fileflyHandlerUrl = '/filefly/api';

    /**
     * additional options for the filemanagerApp
     *
     * @var array
     */
    public $filemanagerWidgetOptions = [];

    /**
     * name of the JS callback that should be triggered when custom 'select item' action is clicked in filemanager item menu
     *
     * @var string
     */
    public $filemanagerCkBrowserSelectItemCallback = 'filemanagerCkBrowserSelect';

    /**
     * JS (as string) where we can find the URL that should be used when an image is selected in ckEditor fileImageBrowser
     *
     * @var string
     */
    public $filemanagerCkBrowserItemImageUrl = 'item.model.urls["image small"]';

    /**
     * JS (as string) where we can find the URL that should be used when a file is selected in ckEditor fileImageBrowser
     *
     * @var string
     */
    public $filemanagerCkBrowserItemFileUrl = 'item.model.urls["download"]';


}
