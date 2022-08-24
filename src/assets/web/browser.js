// ck editor plugin callbacks required for getting filefly as filebrowser backend in ckeditor
// see: https://ckeditor.com/docs/ckeditor4/latest/guide/dev_file_browser_api.html

// helper to extract relevant info from caller url
function filemanagerCkBrowserGetUrlParam( paramName, searchUrl ) {
    // searchUrl = inUrl ? inUrl.toString() : window.location.search;
    var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
    var match = searchUrl.match( reParam );
    return ( match && match.length > 1 ) ? match[1] : null;
}

// get url from filemanager item and return value to the CKEDITOR caller
function filemanagerCkBrowserSelect(item) {
    var funcNum = filemanagerCkBrowserGetUrlParam( 'CKEditorFuncNum', window.location.search );
    url = item.model.fullPath();
    if (item.isImage()) {
        if (window['filemanagerCkBrowserGetImageUrl'] && typeof window['filemanagerCkBrowserGetImageUrl'] === 'function') {
            url = window['filemanagerCkBrowserGetImageUrl'](item);
        }
    } else {
        if (window['filemanagerCkBrowserGetFileUrl'] && typeof window['filemanagerCkBrowserGetFileUrl'] === 'function') {
            url = window['filemanagerCkBrowserGetFileUrl'](item);
        }
    }
    window.opener.CKEDITOR.tools.callFunction( funcNum, url );
    window.close();
}
