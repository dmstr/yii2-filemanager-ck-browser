# yii2-filemanager-ck-browser

This yii2 module provide a ck editor plugin for getting [dmstr/yii2-filemanager-widgets](https://github.com/dmstr/yii2-filemanager-widgets/) as filebrowser in ckeditor.

[ckeditor filebrowser docs](https://ckeditor.com/docs/ckeditor4/latest/guide/dev_file_browser_api.html)

The main ideas behind this module is:
- if we have a [filefly module](https://github.com/dmstr/yii2-filefly-module) we should be able to use [filemanagerWidget](https://github.com/dmstr/yii2-filemanager-widgets/) as fileBrowser from within ckeditor instances
- for this we need:
  - an url (controller/action) that could be used as filebrowser URL
  - a filemanagerWidget (with custom options) which will be displayed when this url is called
  - a JS callback that can be triggered for one item (image or file) from within filemanager
  - configurable JS snippets to be able to define which item property should be used as URL

required config examples to enable an existing filemanager via this module as filebrowser plugin in ckEditor

## yii config

enable the filefly module
```php
    'modules' => [
        # ....
        'filefly' => [
            'filesystemComponents' => [
                'ftp' => 'fsFtp',
            ],
            // define correct image and file(download) urls for images and files for your use cases
            'urlCallback' => function($item) {
                $urls = [];
                $isImageFileExtList = ['jpg', 'jpeg', 'gif', 'tiff', 'tif', 'png', 'bmp'] ;
                if ($item['type'] === 'file') {
                    if (in_array(strtolower($item['extension']), $isImageFileExtList)) {
                        $urls['image small'] = FrontendHelper::getFileFlyPath($item['path'], ImagePresets::MEDIA_CONTENT_S);
                        $urls['image content'] = FrontendHelper::getFileFlyPath($item['path'], ImagePresets::MEDIA_CONTENT);
                        $urls['image big'] = FrontendHelper::getFileFlyPath($item['path'], ImagePresets::MEDIA_CONTENT_BIG);
                    }
                    else {
                        $urls['download'] = FrontendHelper::getFileFlyPath($item['path'], ImagePresets::MEDIA_RAW);
                    }
                }
                return $urls;
            }
        ],

    ],
```

enable the yii2-filemanager-ck-browser module 

```php
    'modules' => [
        # ....
        'filefly-ck-browser' => [
            'class' => \dmstr\filemanagerCkBrowser\Module::class,
            'fileflyHandlerUrl' => '/filefly/api',
            // angular filemanager item prop where the urls should be picked from
            // see: \dmstr\filemanagerCkBrowser\controllers\BrowserController::initCkBrowserVars()
            'filemanagerCkBrowserItemImageUrl' => 'item.model.urls["image content"]',
            'filemanagerCkBrowserItemFileUrl' => 'item.model.urls["download"]'
        ]
        # ....
    ],
```

## ckeditor.config
```
"extraPlugins": "....,filebrowser",
"filebrowserImageBrowseUrl": "/filefly-ck-browser/browser/image",
"filebrowserBrowseUrl": "/filefly-ck-browser/browser/file",
```

for more config options, see [ckeditor filebrowser docs](https://ckeditor.com/docs/ckeditor4/latest/guide/dev_file_browser_api.html)
 
## permissions

according to the 