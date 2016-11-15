<?php
// OptionsFramework Admin Interface

/* ----------------------------------------------------------------------------------- */
/* Options Framework Admin Interface - vcframework_add_admin */
/* ----------------------------------------------------------------------------------- */

// Load static framework options pages 
$functions_path = PW_FILEPATH . '/admin/';

function vcframework_add_admin() {

    global $query_string;

    $pluginname = get_option('pw_pluginname');
    $shortname = get_option('pw_shortname');

    if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'vcframework') {
        if (isset($_REQUEST['pw_save']) && 'reset' == $_REQUEST['pw_save']) {
            $options = get_option('pw_plugin');
            pw_reset_options($options, 'vcframework');
            header("Location: admin.php?page=vcframework&reset=true");
            die;
        }
    }

    $pw_page = add_menu_page($pluginname, $pluginname, 'administrator', 'vcframework', 'vcframework_options_page', PW_FILEPATH . '/admin/images/pathway.png');

    // Add framework functionaily to the head individually
    add_action("admin_print_scripts-$pw_page", 'pw_load_only');
    add_action("admin_print_styles-$pw_page", 'pw_style_only');
}

add_action('admin_menu', 'vcframework_add_admin');

/* ----------------------------------------------------------------------------------- */
/* Options Framework Reset Function - pw_reset_options */
/* ----------------------------------------------------------------------------------- */

function pw_reset_options($options, $page = '') {

    global $wpdb;
    $query_inner = '';
    $count = 0;
    $pw_options             = get_option( 'pw_options' ); // option as default 
    if(empty($pw_options)){
        pw_option_setup();
        $pw_options             = get_option( 'pw_options' ); // option as default 
    }    
    $excludes = array('blogname', 'blogdescription');

    foreach ($options as $option) {

        if (isset($option['id'])) {
            $count++;
            $option_id = $option['id'];
            $option_type = $option['type'];

            //Skip assigned id's
            if (in_array($option_id, $excludes)) {
                continue;
            }

            if ($count > 1) {
                $query_inner .= ' OR ';
            }
            if ($option_type == 'multicheck') {
                $multicount = 0;
                foreach ($option['options'] as $option_key => $option_option) {
                    $multicount++;
                    if ($multicount > 1) {
                        $query_inner .= ' OR ';
                    }
                    $query_inner .= "option_name = '" . $option_id . "_" . $option_key . "'";

                    update_option($option_id, $pw_options[$option_id]);
                }
            } else if (is_array($option_type)) {
                $type_array_count = 0;
                foreach ($option_type as $inner_option) {
                    $type_array_count++;
                    $option_id = $inner_option['id'];
                    if ($type_array_count > 1) {
                        $query_inner .= ' OR ';
                    }
                    $query_inner .= "option_name = '$option_id'";

                    update_option($option_id, $pw_options[$option_id]);
                }
            } else {
                $query_inner .= "option_name = '$option_id'";
                update_option($option_id, $pw_options[$option_id]);

            }
        }
    }

    //When Theme Options page is reset - Add the pw_options option
    if ($page == 'vcframework') {
        $query_inner .= " OR option_name = 'pw_options'";
    }

    //echo $query_inner;

   // $query = "DELETE FROM $wpdb->options WHERE $query_inner";
//    echo $query;
  //  $wpdb->query($query);
}

/* ----------------------------------------------------------------------------------- */
/* Build the Options Page - vcframework_options_page */
/* ----------------------------------------------------------------------------------- */

function vcframework_options_page() {
    $options = get_option('pw_plugin');
    $pluginname = get_option('pw_pluginname');
    ?>

    <div class="wrap" id="pw_container">
        <div id="pw-popup-save" class="pw-save-popup">
            <div class="pw-save-save">Options Updated</div>
        </div>
        <div id="pw-popup-reset" class="pw-save-popup">
            <div class="pw-save-reset">Options Reset</div>
        </div>
        <form action="" enctype="multipart/form-data" id="pwform">
            <div id="header">
                <div class="logo">
                    <img src="<?php echo PW_FILEPATH; ?>/admin/images/pathway80.png" width="52" align="left"/>
                    <h2><?php echo $pluginname; ?></h2>
                    <p>For updates follow us <a href='http://codecanyon.net/user/vennerconcept/'>@codecanyon</a> or twitter <a href='http://twitter.com/vennerlabs'>@vennerconcept</a></p>
                </div>
                <div class="icon-option"> </div>
                <div class="clear"></div>
            </div>
            <?php
            // Rev up the Options Machine
            $return = vcframework_machine($options);
            ?>
            <div id="main">
                <div id="pw-nav">
                    <ul>
                        <?php echo $return[1] ?>
                    </ul>
                </div>
                <div id="content"> <?php echo $return[0]; /* Settings */ ?> </div>
                <div class="clear"></div>
            </div>
            <div class="save_bar_top">
                <img style="display:none" src="<?php echo PW_FILEPATH; ?>/admin/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
                <input type="submit" value="Save All Changes" class="button-primary" />
        </form>
        <form action="<?php echo esc_attr($_SERVER['REQUEST_URI']) ?>" method="post" style="display:inline" id="pwform-reset">
            <span class="submit-footer-reset">
                <input name="reset" type="submit" value="Reset Options" class="button submit-button reset-button" onclick="return confirm('Click OK to reset. Any settings will be lost!');" />
                <input type="hidden" name="pw_save" value="reset" />
            </span>
        </form>
    </div>
    <?php if (!empty($update_message))
        echo $update_message; ?>
    <div style="clear:both;"></div>
    </div>
    <!--wrap-->
    <?php
}

/* ----------------------------------------------------------------------------------- */
/* Load required styles for Options Page - pw_style_only */
/* ----------------------------------------------------------------------------------- */

function pw_style_only() {
    wp_enqueue_style('admin-style', PW_FILEPATH . '/admin/admin-style.css');
    wp_enqueue_style('color-picker', PW_FILEPATH . '/admin/css/colorpicker.css');
}

/* ----------------------------------------------------------------------------------- */
/* Load required javascripts for Options Page - pw_load_only */
/* ----------------------------------------------------------------------------------- */

function pw_load_only() {

    add_action('admin_head', 'pw_admin_head');

    wp_enqueue_script('jquery-ui-core');
    wp_register_script('jquery-input-mask', PW_FILEPATH . '/admin/js/jquery.maskedinput-1.2.2.js', array('jquery'));
    wp_enqueue_script('jquery-input-mask');
    wp_enqueue_script('color-picker', PW_FILEPATH . '/admin/js/colorpicker.js', array('jquery'));
    wp_enqueue_script('ajaxupload', PW_FILEPATH . '/admin/js/ajaxupload.js', array('jquery'));
}

function pw_admin_head() {
    ?>

    <script type="text/javascript" language="javascript">

        jQuery(document).ready(function(){
                    
            //Color Picker
    <?php
    $options = get_option('pw_plugin');

    foreach ($options as $option) {
        if ($option['type'] == 'color' OR $option['type'] == 'typography' OR $option['type'] == 'border' OR $option['type'] == 'shadow' OR $option['type'] == 'bg_pr' OR $option['type'] == 'padding') {
            if ($option['type'] == 'typography' OR $option['type'] == 'border' OR $option['type'] == 'shadow' OR $option['type'] == 'bg_pr' OR $option['type'] == 'padding') {
                $option_id = $option['id'];
                $temp_color = get_option($option_id);
                $option_id = $option['id'] . '_color';
                $color = (isset($temp_color['color'])) ? $temp_color['color'] : ''; 
            } else {
                $option_id = $option['id'];
                $color = get_option($option_id);
            }
            ?>
                            jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '<?php echo $color; ?>');    
                            jQuery('#<?php echo $option_id; ?>_picker').ColorPicker({
                                color: '<?php echo $color; ?>',
                                onShow: function (colpkr) {
                                    jQuery(colpkr).fadeIn(500);
                                    return false;
                                },
                                onHide: function (colpkr) {
                                    jQuery(colpkr).fadeOut(500);
                                    return false;
                                },
                                onChange: function (hsb, hex, rgb) {
                                    //jQuery(this).css('border','1px solid red');
                                    jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '#' + hex);
                                    jQuery('#<?php echo $option_id; ?>_picker').next('input').attr('value','#' + hex);
                                                            
                                }
                            });
        <?php }
    } ?>
                     
        });
                    
    </script>

    <?php
    //AJAX Upload
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
                        
            jQuery('.group').hide();
            jQuery('.group:first').fadeIn();
                            
            jQuery('.group .collapsed').each(function(){
                jQuery(this).find('input:checked').parent().parent().parent().nextAll().each( 
                function(){
                    if (jQuery(this).hasClass('last')) {
                        jQuery(this).removeClass('hidden');
                        return false;
                    }
                    jQuery(this).filter('.hidden').removeClass('hidden');
                });
            });
                                        
            jQuery('.group .collapsed input:checkbox').click(unhideHidden);
                            
            function unhideHidden(){
                if (jQuery(this).attr('checked')) {
                    jQuery(this).parent().parent().parent().nextAll().removeClass('hidden');
                }
                else {
                    jQuery(this).parent().parent().parent().nextAll().each( 
                    function(){
                        if (jQuery(this).filter('.last').length) {
                            jQuery(this).addClass('hidden');
                            return false;
                        }
                        jQuery(this).addClass('hidden');
                    });
                                        
                }
            }
                            
            jQuery('.pw-radio-img-img').click(function(){
                jQuery(this).parent().parent().find('.pw-radio-img-img').removeClass('pw-radio-img-selected');
                jQuery(this).addClass('pw-radio-img-selected');
                                
            });
            jQuery('.pw-radio-img-label').hide();
            jQuery('.pw-radio-img-img').show();
            jQuery('.pw-radio-img-radio').hide();
            jQuery('#pw-nav li:first').addClass('current');
            jQuery('#pw-nav li a').click(function(evt){
                            
                jQuery('#pw-nav li').removeClass('current');
                jQuery(this).parent().addClass('current');
                                    
                var clicked_group = jQuery(this).attr('href');
                     
                jQuery('.group').hide();
                                    
                jQuery(clicked_group).fadeIn();
                    
                evt.preventDefault();
                                    
            });
                            
            if('<?php
    if (isset($_REQUEST['reset'])) {
        echo $_REQUEST['reset'];
    } else {
        echo 'false';
    }
    ?>' == 'true'){
                                
            var reset_popup = jQuery('#pw-popup-reset');
            reset_popup.fadeIn();
            window.setTimeout(function(){
                reset_popup.fadeOut();                        
            }, 2000);
            //alert(response);
                                
        }
                                
        //Update Message popup
        jQuery.fn.center = function () {
            this.animate({"top":( jQuery(window).height() - this.height() - 200 ) / 2+jQuery(window).scrollTop() + "px"},100);
            this.css("left", 250 );
            return this;
        }
                    
                        
        jQuery('#pw-popup-save').center();
        jQuery('#pw-popup-reset').center();
        jQuery(window).scroll(function() { 
                        
            jQuery('#pw-popup-save').center();
            jQuery('#pw-popup-reset').center();
                        
        });
                        
                        
                    
        //AJAX Upload
        jQuery('.image_upload_button').each(function(){
                        
            var clickedObject = jQuery(this);
            var clickedID = jQuery(this).attr('id');    
            new AjaxUpload(clickedID, {
                action: '<?php echo admin_url("admin-ajax.php"); ?>',
                name: clickedID, // File upload name
                data: { // Additional data to send
                    action: 'pw_ajax_post_action',
                    type: 'upload',
                    data: clickedID },
                autoSubmit: true, // Submit file after selection
                responseType: false,
                onChange: function(file, extension){},
                onSubmit: function(file, extension){
                    clickedObject.text('Uploading'); // change button text, when user selects file  
                    this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
                    interval = window.setInterval(function(){
                        var text = clickedObject.text();
                        if (text.length < 13){  clickedObject.text(text + '.'); }
                        else { clickedObject.text('Uploading'); } 
                    }, 200);
                },
                onComplete: function(file, response) {
                               
                    window.clearInterval(interval);
                    clickedObject.text('Upload Image'); 
                    this.enable(); // enable upload button
                                
                    // If there was an error
                    if(response.search('Upload Error') > -1){
                        var buildReturn = '<span class="upload-error">' + response + '</span>';
                        jQuery(".upload-error").remove();
                        clickedObject.parent().after(buildReturn);
                                
                    }
                    else{
                        var buildReturn = '<img class="hide pw-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';
                        jQuery(".upload-error").remove();
                        jQuery("#image_" + clickedID).remove(); 
                        clickedObject.parent().after(buildReturn);
                        jQuery('img#image_'+clickedID).fadeIn();
                        clickedObject.next('span').fadeIn();
                        clickedObject.parent().prev('input').val(response);
                    }
                }
            });
                        
        });
                        
        //AJAX Remove (clear option value)
        jQuery('.image_reset_button').click(function(){
                        
            var clickedObject = jQuery(this);
            var clickedID = jQuery(this).attr('id');
            var theID = jQuery(this).attr('title'); 
                
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
                            
            var data = {
                action: 'pw_ajax_post_action',
                type: 'image_reset',
                data: theID
            };
                                
            jQuery.post(ajax_url, data, function(response) {
                var image_to_remove = jQuery('#image_' + theID);
                var button_to_hide = jQuery('#reset_' + theID);
                image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
                button_to_hide.fadeOut();
                clickedObject.parent().prev('input').val('');
            });
                                
            return false; 
                                
        }); 
                        
        //Save everything else
        jQuery('#pwform').submit(function(){
                            
            function newValues() {
                var serializedValues = jQuery("#pwform").serialize();
                return serializedValues;
            }
            jQuery(":checkbox, :radio").click(newValues);
            jQuery("select").change(newValues);
            jQuery('.ajax-loading-img').fadeIn();
            var serializedReturn = newValues();
                                 
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
                            
            //var data = {data : serializedReturn};
            var data = {
    <?php if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'vcframework') { ?>
                    type: 'options',
    <?php } ?>

                action: 'pw_ajax_post_action',
                data: serializedReturn
            };
                                
            jQuery.post(ajax_url, data, function(response) {
                var success = jQuery('#pw-popup-save');
                var loading = jQuery('.ajax-loading-img');
                loading.fadeOut();  
                success.fadeIn();
                window.setTimeout(function(){
                    success.fadeOut(); 
                                       
                                                            
                }, 2000);
            });
                                
            return false; 
                                
        });         
                            
    });
    </script>
    <?php
}

/* ----------------------------------------------------------------------------------- */
/* Ajax Save Action - pw_ajax_callback */
/* ----------------------------------------------------------------------------------- */

add_action('wp_ajax_pw_ajax_post_action', 'pw_ajax_callback');

function pw_ajax_callback() {
    global $wpdb; // this is how you get access to the database


    $save_type = $_POST['type'];
    //Uploads
    if ($save_type == 'upload') {

        $clickedID = $_POST['data']; // Acts as the name
        $filename = $_FILES[$clickedID];
        $filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']);

        $override['test_form'] = false;
        $override['action'] = 'wp_handle_upload';
        $uploaded_file = wp_handle_upload($filename, $override);

        $upload_tracking[] = $clickedID;
        update_option($clickedID, $uploaded_file['url']);

        if (!empty($uploaded_file['error'])) {
            echo 'Upload Error: ' . $uploaded_file['error'];
        } else {
            echo $uploaded_file['url'];
        } // Is the Response
    } elseif ($save_type == 'image_reset') {

        $id = $_POST['data']; // Acts as the name
        global $wpdb;
        $query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
        $wpdb->query($query);
    } elseif ($save_type == 'options' OR $save_type == 'framework') {
        $data = $_POST['data'];

        parse_str($data, $output);
        //print_r($output);
        //Pull options
        $options = get_option('pw_plugin');

        foreach ($options as $option_array) {

            $id = $option_array['id'];
            $old_value = get_option($id);
            $new_value = '';

            if (isset($output[$id])) {
                $new_value = $output[$option_array['id']];
            }

            if (isset($option_array['id'])) { // Non - Headings...
                $type = $option_array['type'];

                if (is_array($type)) {
                    foreach ($type as $array) {
                        if ($array['type'] == 'text') {
                            $id = $array['id'];
                            $std = $array['std'];
                            $new_value = $output[$id];
                            if ($new_value == '') {
                                $new_value = $std;
                            }
                            update_option($id, stripslashes($new_value));
                        }
                    }
                } elseif ($new_value == '' && $type == 'checkbox') { // Checkbox Save
                    update_option($id, 'false');
                } elseif ($new_value == 'true' && $type == 'checkbox') { // Checkbox Save
                    update_option($id, 'true');
                } elseif ($type == 'multicheck') { // Multi Check Save
                    $option_options = $option_array['options'];

                    foreach ($option_options as $options_id => $options_value) {

                        $multicheck_id = $id . "_" . $options_id;

                        if (!isset($output[$multicheck_id])) {
                            update_option($multicheck_id, 'false');
                        } else {
                            update_option($multicheck_id, 'true');
                        }
                    }
                } elseif ($type == 'typography') {

                    $typography_array = array();

                    $typography_array['size'] = $output[$option_array['id'] . '_size'];

                    $typography_array['face'] = stripslashes($output[$option_array['id'] . '_face']);

                    $typography_array['style'] = $output[$option_array['id'] . '_style'];

                    $typography_array['color'] = $output[$option_array['id'] . '_color'];

                    update_option($id, $typography_array);
                } elseif ($type == 'border') {

                    $border_array = array();

                    $border_array['width'] = $output[$option_array['id'] . '_width'];

                    $border_array['style'] = $output[$option_array['id'] . '_style'];

                    $border_array['color'] = $output[$option_array['id'] . '_color'];

                    update_option($id, $border_array);
                } elseif ($type == 'padding') {

                    $bg_pr_array = array();

                    $bg_pr_array['padding_top'] = $output[$option_array['id'] . '_padding_top'];

                    $bg_pr_array['padding_right'] = $output[$option_array['id'] . '_padding_right'];

                    $bg_pr_array['padding_bottom'] = $output[$option_array['id'] . '_padding_bottom'];

                    $bg_pr_array['padding_left'] = $output[$option_array['id'] . '_padding_left'];

                    update_option($id, $bg_pr_array);
                } elseif ($type == 'bg_pr') {

                    $bg_pr_array = array();

                    $bg_pr_array['position_1'] = $output[$option_array['id'] . '_position_1'];

                    $bg_pr_array['position_2'] = $output[$option_array['id'] . '_position_2'];

                    $bg_pr_array['repeat'] = $output[$option_array['id'] . '_repeat'];

                    update_option($id, $bg_pr_array);
                } elseif ($type == 'shadow') {

                    $shadow_array = array();

                    $shadow_array['style'] = $output[$option_array['id'] . '_style'];

                    $shadow_array['horizontal'] = $output[$option_array['id'] . '_horizontal'];

                    $shadow_array['plus_h'] = $output[$option_array['id'] . '_plus_h'];

                    $shadow_array['vertical'] = $output[$option_array['id'] . '_vertical'];

                    $shadow_array['plus_v'] = $output[$option_array['id'] . '_plus_v'];

                    $shadow_array['blur'] = $output[$option_array['id'] . '_blur'];

                    $shadow_array['spread'] = $output[$option_array['id'] . '_spread'];

                    $shadow_array['color'] = $output[$option_array['id'] . '_color'];

                    update_option($id, $shadow_array);
                } elseif ($type != 'upload_min') {

                    update_option($id, stripslashes($new_value));
                }
            }
        }
    }

    die();
}

/* ----------------------------------------------------------------------------------- */
/* Generates The Options Within the Panel - vcframework_machine */
/* ----------------------------------------------------------------------------------- */

function vcframework_machine($options) {

    $counter = 0;
    $menu = '';
    $output = '';
    foreach ($options as $value) {

        $counter++;
        $val = '';
        //Start Heading
        if ($value['type'] != "heading") {
            $class = '';
            if (isset($value['class'])) {
                $class = $value['class'];
            }
            //$output .= '<div class="section section-'. $value['type'] .'">'."\n".'<div class="option-inner">'."\n";
            $output .= '<div class="section section-' . $value['type'] . ' ' . $class . '">' . "\n";
            $output .= '<h3 class="heading">' . $value['name'] . '</h3>' . "\n";
            $output .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
        }
        //End Heading
        $select_value = '';
        switch ($value['type']) {

            case 'text':
                $val = $value['std'];
                $size = (isset($value['size'])) ? $value['size'] : "";
                $std = get_option($value['id']);
                if ($std != "") {
                    $val = $std;
                }
                $classsize="";
                if($size!="large"){
                	$classsize="input-text-small";
                }
                $output .= '<input class="pw-input '.$classsize.'" name="' . $value['id'] . '" id="' . $value['id'] . '" type="' . $value['type'] . '" value="' . $val . '" />';
                break;

            case 'select':

                $output .= '<select class="pw-input" name="' . $value['id'] . '" id="' . $value['id'] . '">';

                $select_value = get_option($value['id']);

                foreach ($value['options'] as $option) {

                    $selected = '';

                    if ($select_value != '') {
                        if ($select_value == $option) {
                            $selected = ' selected="selected"';
                        }
                    } else {
                        if (isset($value['std']))
                            if ($value['std'] == $option) {
                                $selected = ' selected="selected"';
                            }
                    }

                    $output .= '<option' . $selected . '>';
                    $output .= $option;
                    $output .= '</option>';
                }
                $output .= '</select>';


                break;
            case 'select2':

                $output .= '<select class="pw-input" name="' . $value['id'] . '" id="' . $value['id'] . '">';

                $select_value = get_option($value['id']);

                foreach ($value['options'] as $option => $name) {

                    $selected = '';

                    if ($select_value != '') {
                        if ($select_value == $option) {
                            $selected = ' selected="selected"';
                        }
                    } else {
                        if (isset($value['std']))
                            if ($value['std'] == $option) {
                                $selected = ' selected="selected"';
                            }
                    }

                    $output .= '<option' . $selected . ' value="' . $option . '">';
                    $output .= $name;
                    $output .= '</option>';
                }
                $output .= '</select>';


                break;
            case 'textarea':

                $cols = '8';
                $ta_value = '';

                if (isset($value['std'])) {

                    $ta_value = $value['std'];

                    if (isset($value['options'])) {
                        $ta_options = $value['options'];
                        if (isset($ta_options['cols'])) {
                            $cols = $ta_options['cols'];
                        } else {
                            $cols = '8';
                        }
                    }
                }
                $std = get_option($value['id']);
                if ($std != "") {
                    $ta_value = stripslashes($std);
                }
                $output .= '<textarea class="pw-input" name="' . $value['id'] . '" id="' . $value['id'] . '" cols="' . $cols . '" rows="8">' . $ta_value . '</textarea>';


                break;
            case "radio":

                $select_value = get_option($value['id']);

                foreach ($value['options'] as $key => $option) {

                    $checked = '';
                    if ($select_value != '') {
                        if ($select_value == $key) {
                            $checked = ' checked';
                        }
                    } else {
                        if ($value['std'] == $key) {
                            $checked = ' checked';
                        }
                    }
                    $output .= '<input class="pw-input pw-radio" type="radio" name="' . $value['id'] . '" value="' . $key . '" ' . $checked . ' />' . $option . '<div class="clear"></div>';
                }

                break;
            case "checkbox":

                $std = $value['std'];

                $saved_std = get_option($value['id']);

                $checked = '';

                if (!empty($saved_std)) {
                    if ($saved_std == 'true') {
                        $checked = 'checked="checked"';
                    } else {
                        $checked = '';
                    }
                } elseif ($std == 'true') {
                    $checked = 'checked="checked"';
                } else {
                    $checked = '';
                }
                $output .= '<input type="checkbox" class="checkbox pw-input" name="' . $value['id'] . '" id="' . $value['id'] . '" value="true" ' . $checked . ' />';

                break;
            case "multicheck":

                $std = $value['std'];

                foreach ($value['options'] as $key => $option) {

                    $pw_key = $value['id'] . '_' . $key;
                    $saved_std = get_option($pw_key);

                    if (!empty($saved_std)) {
                        if ($saved_std == 'true') {
                            $checked = 'checked="checked"';
                        } else {
                            $checked = '';
                        }
                    } elseif ($std == $key) {
                        $checked = 'checked="checked"';
                    } else {
                        $checked = '';
                    }
                    $output .= '<input type="checkbox" class="checkbox pw-input" name="' . $pw_key . '" id="' . $pw_key . '" value="true" ' . $checked . ' /><label for="' . $pw_key . '">' . $option . '</label><div class="clear"></div>';
                }
                break;
            case "upload":

                $output .= vcframework_uploader_function($value['id'], $value['std'], null);

                break;
            case "upload_min":

                $output .= vcframework_uploader_function($value['id'], $value['std'], 'min');

                break;
            case "color":
                $val = $value['std'];
                $stored = get_option($value['id']);
                if ($stored != "") {
                    $val = $stored;
                }
                $output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div></div></div>';
                $output .= '<input class="pw-color" name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" value="' . $val . '" />';
                break;

            case "typography":

                $default = $value['std'];
                $typography_stored = get_option($value['id']);

                /* Font Size */
                $val = $default['size'];
                if ($typography_stored['size'] != "") {
                    $val = $typography_stored['size'];
                }
                $output .= '<select class="pw-typography pw-typography-size" name="' . $value['id'] . '_size" id="' . $value['id'] . '_size">';
                for ($i = 9; $i < 71; $i++) {
                    if ($val == $i) {
                        $active = 'selected="selected"';
                    } else {
                        $active = '';
                    }
                    $output .= '<option value="' . $i . '" ' . $active . '>' . $i . 'px</option>';
                }
                $output .= '</select>';

                /* Font Face */
                $val = $default['face'];
                if ($typography_stored['face'] != "")
                    $val = $typography_stored['face'];

                $font01 = '';
                $font02 = '';
                $font03 = '';
                $font04 = '';
                $font05 = '';
                $font06 = '';
                $font07 = '';
                $font08 = '';
                $font09 = '';

                if (strpos($val, 'Arial, sans-serif') !== false) {
                    $font01 = 'selected="selected"';
                }
                if (strpos($val, 'Verdana, Geneva') !== false) {
                    $font02 = 'selected="selected"';
                }
                if (strpos($val, 'Trebuchet') !== false) {
                    $font03 = 'selected="selected"';
                }
                if (strpos($val, 'Georgia') !== false) {
                    $font04 = 'selected="selected"';
                }
                if (strpos($val, 'Times New Roman') !== false) {
                    $font05 = 'selected="selected"';
                }
                if (strpos($val, 'Tahoma, Geneva') !== false) {
                    $font06 = 'selected="selected"';
                }
                if (strpos($val, 'Palatino') !== false) {
                    $font07 = 'selected="selected"';
                }
                if (strpos($val, 'Helvetica') !== false) {
                    $font08 = 'selected="selected"';
                }

                $output .= '<select class="pw-typography pw-typography-face" name="' . $value['id'] . '_face" id="' . $value['id'] . '_face">';
                $output .= '<option value="Arial, sans-serif" ' . $font01 . '>Arial</option>';
                $output .= '<option value="Verdana, Geneva, sans-serif" ' . $font02 . '>Verdana</option>';
                $output .= '<option value="&quot;Trebuchet MS&quot;, Tahoma, sans-serif"' . $font03 . '>Trebuchet</option>';
                $output .= '<option value="Georgia, serif" ' . $font04 . '>Georgia</option>';
                $output .= '<option value="&quot;Times New Roman&quot;, serif"' . $font05 . '>Times New Roman</option>';
                $output .= '<option value="Tahoma, Geneva, Verdana, sans-serif"' . $font06 . '>Tahoma</option>';
                $output .= '<option value="Palatino, &quot;Palatino Linotype&quot;, serif"' . $font07 . '>Palatino</option>';
                $output .= '<option value="&quot;Helvetica Neue&quot;, Helvetica, sans-serif" ' . $font08 . '>Helvetica*</option>';
                $output .= '</select>';

                /* Font Weight */
                $val = $default['style'];
                if ($typography_stored['style'] != "") {
                    $val = $typography_stored['style'];
                }
                $normal = '';
                $italic = '';
                $bold = '';
                $bolditalic = '';
                if ($val == 'normal') {
                    $normal = 'selected="selected"';
                }
                if ($val == 'italic') {
                    $italic = 'selected="selected"';
                }
                if ($val == 'bold') {
                    $bold = 'selected="selected"';
                }
                if ($val == 'bold italic') {
                    $bolditalic = 'selected="selected"';
                }

                $output .= '<select class="pw-typography pw-typography-style" name="' . $value['id'] . '_style" id="' . $value['id'] . '_style">';
                $output .= '<option value="normal" ' . $normal . '>Normal</option>';
                $output .= '<option value="italic" ' . $italic . '>Italic</option>';
                $output .= '<option value="bold" ' . $bold . '>Bold</option>';
                $output .= '<option value="bold italic" ' . $bolditalic . '>Bold/Italic</option>';
                $output .= '</select>';

                /* Font Color */
                $val = $default['color'];
                if ($typography_stored['color'] != "") {
                    $val = $typography_stored['color'];
                }
                $output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div></div></div>';
                $output .= '<input class="pw-color pw-typography pw-typography-color" name="' . $value['id'] . '_color" id="' . $value['id'] . '_color" type="text" value="' . $val . '" />';

                break;

            case "border":

                $default = $value['std'];
                $border_stored = get_option($value['id']);

                /* Border Width */
                $val = $default['width'];
                if ($border_stored['width'] != "") {
                    $val = $border_stored['width'];
                }
                $output .= '<select class="pw-border pw-border-width" name="' . $value['id'] . '_width" id="' . $value['id'] . '_width">';
                for ($i = 0; $i < 21; $i++) {
                    if ($val == $i) {
                        $active = 'selected="selected"';
                    } else {
                        $active = '';
                    }
                    $output .= '<option value="' . $i . '" ' . $active . '>' . $i . 'px</option>';
                }
                $output .= '</select>';

                /* Border Style */
                $val = $default['style'];
                if ($border_stored['style'] != "") {
                    $val = $border_stored['style'];
                }
                $solid = '';
                $dashed = '';
                $dotted = '';
                if ($val == 'solid') {
                    $solid = 'selected="selected"';
                }
                if ($val == 'dashed') {
                    $dashed = 'selected="selected"';
                }
                if ($val == 'dotted') {
                    $dotted = 'selected="selected"';
                }

                $output .= '<select class="pw-border pw-border-style" name="' . $value['id'] . '_style" id="' . $value['id'] . '_style">';
                $output .= '<option value="solid" ' . $solid . '>Solid</option>';
                $output .= '<option value="dashed" ' . $dashed . '>Dashed</option>';
                $output .= '<option value="dotted" ' . $dotted . '>Dotted</option>';
                $output .= '</select>';

                /* Border Color */
                $val = $default['color'];
                if ($border_stored['color'] != "") {
                    $val = $border_stored['color'];
                }
                $output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div></div></div>';
                $output .= '<input class="pw-color pw-border pw-border-color" name="' . $value['id'] . '_color" id="' . $value['id'] . '_color" type="text" value="' . $val . '" />';

                break;

            case "padding":

                $default = $value['std'];
                $padding_stored = get_option($value['id']);

                /* padding top */
                if ($padding_stored['padding_top'] != "") {
                    $val = $padding_stored['padding_top'];
                }
                $output .= '<input class="pw-input input-text-small" name="' . $value['id'] . '_padding_top" id="' . $value['id'] . '_padding_top" type="text" value="' . $val . '" />px&nbsp;&nbsp;: &nbsp;Padding Top<div class="clear"></div>';

                /* padding right */
                if ($padding_stored['padding_right'] != "") {
                    $val = $padding_stored['padding_right'];
                }
                $output .= '<input class="pw-input input-text-small" name="' . $value['id'] . '_padding_right" id="' . $value['id'] . '_padding_right" type="text" value="' . $val . '" />px&nbsp;&nbsp;: &nbsp;Padding Right<div class="clear"></div>';

                /* padding bottom */
                if ($padding_stored['padding_bottom'] != "") {
                    $val = $padding_stored['padding_bottom'];
                }
                $output .= '<input class="pw-input input-text-small" name="' . $value['id'] . '_padding_bottom" id="' . $value['id'] . '_padding_bottom" type="text" value="' . $val . '" />px&nbsp;&nbsp;: &nbsp;Padding Bottom<div class="clear"></div>';

                /* padding left */
                if ($padding_stored['padding_left'] != "") {
                    $val = $padding_stored['padding_left'];
                }
                $output .= '<input class="pw-input input-text-small" name="' . $value['id'] . '_padding_left" id="' . $value['id'] . '_padding_left" type="text" value="' . $val . '" />px&nbsp;&nbsp;: &nbsp;Padding Left';

                break;

            case "bg_pr":

                $default = $value['std'];
                $bg_pr_stored = get_option($value['id']);

                /* bg_pr Position 1 */
                $val = $default['position_1'];
                if ($bg_pr_stored['position_1'] != "") {
                    $val = $bg_pr_stored['position_1'];
                }
                $top = '';
                $center = '';
                $bottom = '';

                if ($val == 'top') {
                    $top = 'selected="selected"';
                }
                if ($val == 'center') {
                    $center = 'selected="selected"';
                }
                if ($val == 'bottom') {
                    $bottom = 'selected="selected"';
                }

                $output .= '<select class="pw-typography pw-typography-style" name="' . $value['id'] . '_position_1" id="' . $value['id'] . '_position_1">';
                $output .= '<option value="top" ' . $top . '>top</option>';
                $output .= '<option value="center" ' . $center . '>center</option>';
                $output .= '<option value="bottom" ' . $bottom . '>bottom</option>';
                $output .= '</select>&nbsp;&nbsp;: &nbsp;Position Vertical<div class="clear"></div>';

                /* bg_pr Position 2 */
                $val = $default['position_2'];
                if ($bg_pr_stored['position_2'] != "") {
                    $val = $bg_pr_stored['position_2'];
                }
                $left = '';
                $center = '';
                $right = '';

                if ($val == 'left') {
                    $left = 'selected="selected"';
                }
                if ($val == 'center') {
                    $center = 'selected="selected"';
                }
                if ($val == 'right') {
                    $right = 'selected="selected"';
                }

                $output .= '<select class="pw-typography pw-typography-style" name="' . $value['id'] . '_position_2" id="' . $value['id'] . '_position_2">';
                $output .= '<option value="left" ' . $left . '>left</option>';
                $output .= '<option value="center" ' . $center . '>center</option>';
                $output .= '<option value="right" ' . $right . '>right</option>';
                $output .= '</select>&nbsp;&nbsp;: &nbsp;Position Horizontal<div class="clear"></div>';

                /* bg_pr Repeat */
                $val = $default['repeat'];
                if ($bg_pr_stored['repeat'] != "") {
                    $val = $bg_pr_stored['repeat'];
                }
                $no_repeat = '';
                $repeat = '';
                $repeat_x = '';
                $repeat_y = '';
                $cover = '';
                if ($val == 'no-repeat') {
                    $no_repeat = 'selected="selected"';
                }
                if ($val == 'repeat') {
                    $repeat = 'selected="selected"';
                }
                if ($val == 'repeat-x') {
                    $repeat_x = 'selected="selected"';
                }
                if ($val == 'repeat-y') {
                    $repeat_y = 'selected="selected"';
                }
                if ($val == 'cover') {
                    $repeat_y = 'selected="selected"';
                }

                $output .= '<select class="pw-typography pw-typography-style" name="' . $value['id'] . '_repeat" id="' . $value['id'] . '_repeat">';
                $output .= '<option value="no-repeat" ' . $no_repeat . '>no-repeat</option>';
                $output .= '<option value="repeat" ' . $repeat . '>repeat</option>';
                $output .= '<option value="repeat-x" ' . $repeat_x . '>repeat-x</option>';
                $output .= '<option value="repeat-y" ' . $repeat_y . '>repeat-y</option>';
                $output .= '<option value="cover" ' . $cover . '>cover</option>';
                $output .= '</select>&nbsp;&nbsp;: &nbsp;Repeat';

                break;

            case "shadow":

                $default = $value['std'];
                $shadow_stored = get_option($value['id']);

                /* shadow Style */
                $val = $default['style'];
                if ($shadow_stored['style'] != "") {
                    $val = $shadow_stored['style'];
                }
                $none = '';
                $inset = '';
                if ($val == '') {
                    $none = 'selected="selected"';
                }
                if ($val == 'inset') {
                    $inset = 'selected="selected"';
                }

                $output .= '<select class="pw-typography pw-typography-style" name="' . $value['id'] . '_style" id="' . $value['id'] . '_style">';
                $output .= '<option value="" ' . $none . '>None</option>';
                $output .= '<option value="inset" ' . $inset . '>Inset</option>';
                $output .= '</select>&nbsp;&nbsp;: &nbsp;Inset<div class="clear"></div>';

                /* shadow horizontal */
                $val = $default['horizontal'];
                if ($shadow_stored['horizontal'] != "") {
                    $val = $shadow_stored['horizontal'];
                }

                $active_h="";
                if(isset($shadow_stored['plus_h']))
                if ($shadow_stored['plus_h'] == "-") {
                    $active_h = 'selected="selected"';
                }
                $output .= '<select name="' . $value['id'] . '_plus_h"  id="' . $value['id'] . '_plus_h" style="
                    width: 40px;
                    float: left;
                ">
                  <option>+</option>
                  <option '.$active_h.'>-</option>
                </select>
<select class="pw-typography pw-typography-style" name="' . $value['id'] . '_horizontal" id="' . $value['id'] . '_horizontal">';
                for ($z = 0; $z < 17; $z++) {
                    if ($val == $z) {
                        $active = 'selected="selected"';
                    } else {
                        $active = '';
                    }
                    $output .= '<option value="' . $z . '" ' . $active . '>' . $z . 'px</option>';
                }
                $output .= '</select>&nbsp;&nbsp;: &nbsp;Horizontal<div class="clear"></div>';

                /* shadow vertical */
                $val = $default['vertical'];
                if ($shadow_stored['vertical'] != "") {
                    $val = $shadow_stored['vertical'];
                }
                
                $active_v = '';

                if(isset($shadow_stored['plus_h']))
                if ($shadow_stored['plus_v'] == "-") {
                    $active_v = 'selected="selected"';
                }
                $output .= '<select name="' . $value['id'] . '_plus_v"  id="' . $value['id'] . '_plus_v" style="
                    width: 40px;
                    float: left;
                ">
                  <option>+</option>
                  <option '.$active_v.'>-</option>
                </select>
                <select class="pw-typography pw-typography-style" name="' . $value['id'] . '_vertical" id="' . $value['id'] . '_vertical">';
                for ($x = 0; $x < 17; $x++) {
                    if ($val == $x) {
                        $active = 'selected="selected"';
                    } else {
                        $active = '';
                    }
                    $output .= '<option value="' . $x . '" ' . $active . '>' . $x . 'px</option>';
                }
                $output .= '</select>&nbsp;&nbsp;: &nbsp;Vertical<div class="clear"></div>';

                /* shadow Blur Radius */
                $val = $default['blur'];
                if ($shadow_stored['blur'] != "") {
                    $val = $shadow_stored['blur'];
                }
                $output .= '<select class="pw-typography pw-typography-style" name="' . $value['id'] . '_blur" id="' . $value['id'] . '_blur">';
                for ($c = 0; $c < 17; $c++) {
                    if ($val == $c) {
                        $active = 'selected="selected"';
                    } else {
                        $active = '';
                    }
                    $output .= '<option value="' . $c . '" ' . $active . '>' . $c . 'px</option>';
                }
                $output .= '</select>&nbsp;&nbsp;: &nbsp;Blur Radius<div class="clear"></div>';

                /* shadow Spread */
                $val = $default['spread'];
                if ($shadow_stored['spread'] != "") {
                    $val = $shadow_stored['spread'];
                }
                $output .= '<select class="pw-typography pw-typography-style" name="' . $value['id'] . '_spread" id="' . $value['id'] . '_spread">';
                for ($v = 0; $v < 17; $v++) {
                    if ($val == $v) {
                        $active = 'selected="selected"';
                    } else {
                        $active = '';
                    }
                    $output .= '<option value="' . $v . '" ' . $active . '>' . $v . 'px</option>';
                }
                $output .= '</select>&nbsp;&nbsp;: &nbsp;Spread<div class="clear"></div>';

                /* Border Color */
                $val = $default['color'];
                if ($shadow_stored['color'] != "") {
                    $val = $shadow_stored['color'];
                }
                $output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div></div></div>';
                $output .= '<input class="pw-color pw-typography pw-typography-color" name="' . $value['id'] . '_color" id="' . $value['id'] . '_color" type="text" value="' . $val . '" />&nbsp;&nbsp;: &nbsp;Color';

                break;

            case "images":
                $i = 0;
                $select_value = get_option($value['id']);

                foreach ($value['options'] as $key => $option) {
                    $i++;

                    $checked = '';
                    $selected = '';
                    if ($select_value != '') {
                        if ($select_value == $key) {
                            $checked = ' checked';
                            $selected = 'pw-radio-img-selected';
                        }
                    } else {
                        if ($value['std'] == $key) {
                            $checked = ' checked';
                            $selected = 'pw-radio-img-selected';
                        } elseif ($i == 1 && !isset($select_value)) {
                            $checked = ' checked';
                            $selected = 'pw-radio-img-selected';
                        } elseif ($i == 1 && $value['std'] == '') {
                            $checked = ' checked';
                            $selected = 'pw-radio-img-selected';
                        } else {
                            $checked = '';
                        }
                    }

                    $output .= '<span>';
                    $output .= '<input type="radio" id="pw-radio-img-' . $value['id'] . $i . '" class="checkbox pw-radio-img-radio" value="' . $key . '" name="' . $value['id'] . '" ' . $checked . ' />';
                    $output .= '<div class="pw-radio-img-label">' . $key . '</div>';
                    $output .= '<img src="' . $option . '" alt="" class="pw-radio-img-img ' . $selected . '" onClick="document.getElementById(\'pw-radio-img-' . $value['id'] . $i . '\').checked = true;" />';
                    $output .= '</span>';
                }

                break;

            case "info":
                $default = $value['std'];
                $output .= $default;
                break;

            case "heading":

                if ($counter >= 2) {
                    $output .= '</div>' . "\n";
                }
                $jquery_click_hook = preg_replace("/[^A-Za-z0-9]/", "", strtolower($value['name']));
                $jquery_click_hook = "pw-option-" . $jquery_click_hook;
                $menu .= '<li class="' . $jquery_click_hook . '"><a title="' . $value['name'] . '" href="#' . $jquery_click_hook . '">' . $value['name'] . '</a></li>';
                $output .= '<div class="group" id="' . $jquery_click_hook . '"><h2>' . $value['name'] . '</h2>' . "\n";
                break;
        }

        // if TYPE is an array, formatted into smaller inputs... ie smaller values
        if (is_array($value['type'])) {
            foreach ($value['type'] as $array) {

                $id = $array['id'];
                $std = $array['std'];
                $saved_std = get_option($id);
                if ($saved_std != $std) {
                    $std = $saved_std;
                }
                $meta = $array['meta'];

                if ($array['type'] == 'text') { // Only text at this point
                    $output .= '<input class="input-text-small pw-input" name="' . $id . '" id="' . $id . '" type="text" value="' . $std . '" />';
                    $output .= '<span class="meta-two">' . $meta . '</span>';
                }
            }
        }
        if ($value['type'] != "heading") {
            if ($value['type'] != "checkbox") {
                $output .= '<br/>';
            }
            if (!isset($value['desc'])) {
                $explain_value = '';
            } else {
                $explain_value = $value['desc'];
            }
            $output .= '</div><div class="explain">' . $explain_value . '</div>' . "\n";
            $output .= '<div class="clear"> </div></div></div>' . "\n";
        }
    }
    $output .= '</div>';
    return array($output, $menu);
}

/* ----------------------------------------------------------------------------------- */
/* OptionsFramework Uploader - vcframework_uploader_function */
/* ----------------------------------------------------------------------------------- */

function vcframework_uploader_function($id, $std, $mod) {
    wp_enqueue_media();
    //$uploader .= '<input type="file" id="attachement_'.$id.'" name="attachement_'.$id.'" class="upload_input"></input>';
    //$uploader .= '<span class="submit"><input name="save" type="submit" value="Upload" class="button upload_save" /></span>';

    $uploader = '';
    $upload = get_option($id);

     $uploader .= '<a class="pw-uploaded-image" href="#">';
        $uploader .= '<img class="pw-option-image" id="image_' . $id . '" src="' . $upload . '" alt="" />';
        $uploader .= '</a>';

    if ($mod != 'min') {
        $val = $std;
        if (get_option($id) != "") {
            $val = get_option($id);
        }
        $uploader .= '<input class="pw-input" name="' . $id . '" id="' . $id . '_upload" type="text" value="' . $val . '" />';
    }

    $uploader .= '

        <div class="upload_image_buttons"><span class="button pw_input_media" id="' . $id . '">Upload Image</span>';

    if (!empty($upload)) {
        $hide = '';
    } else {
        $hide = 'hide';
    }

    $uploader .= '<span class="button pw_remove_media ' . $hide . '" id="reset_' . $id . '" title="' . $id . '">Remove</span>';
    $uploader .='</div>' . "\n";
    $uploader .= '<div class="clear"></div>' . "\n";
   // if (!empty($upload)) {
       //}
    $uploader .= '<div class="clear"></div>' . "\n";


    return $uploader;
}
?>
