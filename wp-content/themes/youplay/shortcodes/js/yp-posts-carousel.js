(function() {
    tinymce.create('tinymce.plugins.YPPostsCarousel', {
        init : function(editor, url) {
            editor.addButton('yp_posts_carousel', {
                title   : 'YP Posts Carousel',
                icon    : 'fa-arrows-h',
                onclick : function() {
                    editor.execCommand('mceInsertContent', false, '[yp_posts_carousel style="1" posts="1,2,3" show_price="true" show_rating="true" show_discount_badges="true" badges_always_show="false" boxed="false"]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname  : "YP Posts Carousel Shortcode",
                author    : 'nK',
                authorurl : 'http://nkdev.info/',
                infourl   : 'http://nkdev.info/',
                version   : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('yp_posts_carousel', tinymce.plugins.YPPostsCarousel);
})();