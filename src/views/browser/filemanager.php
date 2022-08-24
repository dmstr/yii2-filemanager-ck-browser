<?php

/** @var string $handlerUrl */
/** @var array $filemanagerWidgetOptions */

use yii\helpers\Html;
use yii\helpers\Url;


if (class_exists(\hrzg\filemanager\widgets\FileManagerWidget::class)) {

    echo \hrzg\filemanager\widgets\FileManagerWidget::widget(
        [
            'handlerUrl' => Url::to($handlerUrl),
            'options' => $filemanagerWidgetOptions
        ]
    );
} else {
    echo Html::tag('p', Yii::t('filefly', 'Filemanager widgets are not available.'));
}

