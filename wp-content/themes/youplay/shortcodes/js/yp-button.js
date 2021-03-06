(function() {
    tinymce.create('tinymce.plugins.YPButton', {
        init : function(editor, url) {
            editor.addButton('yp_button', {
                title   : 'YP Button',
                icon    : 'fa-square-o',
                onclick : function() {
                    editor.execCommand('mceInsertContent', false, '[yp_button href="http://nkdev.info" size="lg" full_width="false" active="false" color="success" icon_before="fa fa-html5" icon_after=""]Youplay[/yp_button]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname  : "YP Button Shortcode",
                author    : 'nK',
                authorurl : 'http://nkdev.info/',
                infourl   : 'http://nkdev.info/',
                version   : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('yp_button', tinymce.plugins.YPButton);
})();