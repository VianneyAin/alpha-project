(function() {
    tinymce.create('tinymce.plugins.YPBanner', {
        init : function(editor, url) {
            editor.addButton('yp_banner', {
                title   : 'YP Banner',
                icon    : 'fa-picture-o',
                onclick : function() {
                    editor.execCommand('mceInsertContent', false, '[yp_banner img_src="14" img_size="1400x600" banner_size="mid" top_position="false" img_cover="false" boxed="false"]Content[/yp_banner]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname  : "YP Banner Shortcode",
                author    : 'nK',
                authorurl : 'http://nkdev.info/',
                infourl   : 'http://nkdev.info/',
                version   : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('yp_banner', tinymce.plugins.YPBanner);
})();