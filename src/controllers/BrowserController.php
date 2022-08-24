<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2021 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\filemanagerCkBrowser\controllers;

use dmstr\filemanagerCkBrowser\assets\FileflyCkBrowserAsset;
use dmstr\filemanagerCkBrowser\Module;
use yii\helpers\ArrayHelper;
use yii\web\View;

class BrowserController extends \hrzg\filefly\controllers\DefaultController
{

    protected $handlerUrl;

    protected $filemanagerWidgetOptions;

    public function init()
    {
        parent::init();
        /** @var Module layout */
        $this->layout = $this->module->fileBrowserLayout;
        $this->handlerUrl = \yii\helpers\Url::to($this->module->fileflyHandlerUrl);
        $this->initFileManagerWidgetOptions();
        $this->initCkBrowserVars();
    }

    /**
     * action for filebrowserImageBrowseUrl
     *
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionImage($context = null)
    {
        $this->view->registerAssetBundle(FileflyCkBrowserAsset::class);
        return $this->render('filemanager', ['handlerUrl' => $this->handlerUrl, 'filemanagerWidgetOptions' => $this->filemanagerWidgetOptions]);
    }

    /**
     * action for filebrowserImageBrowseUrl
     *
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionFile($context = null)
    {
        $this->view->registerAssetBundle(FileflyCkBrowserAsset::class);
        return $this->render('filemanager', ['handlerUrl' => $this->handlerUrl, 'filemanagerWidgetOptions' => $this->filemanagerWidgetOptions]);
    }

    protected function initCkBrowserVars()
    {
        $js = '';
        if (!empty($this->module->filemanagerCkBrowserItemImageUrl)) {
            $js .= 'function filemanagerCkBrowserGetImageUrl(item) { return ' . $this->module->filemanagerCkBrowserItemImageUrl . '; }; ';
        }
        if (!empty($this->module->filemanagerCkBrowserItemImageUrl)) {
            $js .= 'function filemanagerCkBrowserGetFileUrl(item) { return ' . $this->module->filemanagerCkBrowserItemFileUrl . '; }; ';
        }
        \Yii::debug($js);
        $this->view->registerJs($js, View::POS_HEAD);
    }

    /**
     * init filemanagerWidgetOptions array from own default and (if set) options defined via module config
     *
     * @return void
     */
    protected function initFileManagerWidgetOptions() {

        $this->filemanagerWidgetOptions = [
            'searchForm' => true,
            'enableThumbnails' => true,
            'enableIconPreviewView' => true,
            'allowedActions' => [
                'rename' => false,
                'move' => false,
                'edit' => false,
                'copy' => false,
                'upload' => false,
                'remove' => false,
                'compress' => false,
                'createFolder' => false,
                'changePermissions' => false,
                'downloadLink' => false,
                'download' => false,
                'customFileActions' => [
                    'select file' => $this->module->filemanagerCkBrowserSelectItemCallback ?: 'filemanagerCkBrowserSelect',
                ],
            ]
        ];
        if (!empty($this->module->filemanagerWidgetOptions) && is_array($this->module->filemanagerWidgetOptions)) {
            $this->filemanagerWidgetOptions = ArrayHelper::merge($this->filemanagerWidgetOptions, $this->module->filemanagerWidgetOptions);
        }
    }

}