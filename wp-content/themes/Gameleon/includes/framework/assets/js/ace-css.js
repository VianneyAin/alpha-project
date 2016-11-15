( function( global, $ ) {
    var editor,
    syncCSS = function() {
        $( '#custom_css_textarea' ).val( editor.getSession().getValue() );
    },
    loadAce = function() {
        editor = ace.edit( 'custom_css' );
        global.safecss_editor = editor;
        editor.setShowPrintMargin(false);
        jQuery.fn.spin&&$( '#custom_css_container' ).spin(false);
        editor.setTheme("ace/theme/twilight");
        editor.getSession().setMode("ace/mode/css");
        editor.getSession().setValue( $( '#custom_css_textarea' ).val() );
        editor.getSession().on('change', function(){
          $( '#custom_css_textarea' ).val(editor.getSession().getValue());
      });
    };
    if ( $.browser.msie&&parseInt( $.browser.version, 10 ) <= 7 ) {
        $( '#custom_css_container' ).hide();
        $( '#custom_css_textarea' ).show();
        return false;
    } else {
        $( global ).load( loadAce );
    }
    global.aceSyncCSS = syncCSS;
} )( this, jQuery );