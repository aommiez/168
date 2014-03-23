<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 23/3/2557
 * Time: 9:38 น.
 * To change this template use File | Settings | File Templates.
 */

$path = __DIR__.'/footer.ini';

require_once("../class/INI.class.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $write['footer'] = $_POST;
    INI::write($path, $write);
}

$read = INI::read($path);
$read = @$read["footer"];
?>
<ol class="breadcrumb">
    <li><a href="home.php?page=setting">Setting</a></li>
    <li class="active">Footer</li>
</ol>
<form method="post" enctype="multipart/form-data" style="width: 900px; padding-bottom: 20px;">
    <fieldset>
        <legend>Footer</legend>
        <div class="form-group">
            <label class="col-md-4 control-label">footer text</label>
            <div class="col-md-4">
                <textarea name="footer_text" class="form-control"><?php echo @$read['footer_text'];?></textarea>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for=""></label>
            <div class="col-md-4">
                <button id="" name="" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </fieldset>
</form>
<script type="text/javascript">
    tinyMCE.init({

        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "media,table,youtube",
        //plugins : "table,youtube",
        setup : function(ed){
            ed.onInit.add(function(ed)
            {
                ed.getDoc().body.style.fontSize = 'small';
            });
        },

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,backcolor,|,link,unlink,|,fontsizeselect,|,code",
        theme_advanced_buttons2 : "tablecontrols,|,youtube",
        theme_advanced_buttons3 : "",

        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
        //theme_advanced_runtime_fontsize: 'small',

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "css/word.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        relative_urls : false,
        remove_script_host : false,
        convert_urls : true,
        document_base_url : '',

        extended_valid_elements : "object[classid|codebase|width|height|align],param[name|value],embed[quality|type|pluginspage|width|height|src|align]",

        // Replace values for the template plugin
        template_replace_values : {
            username : "Some User",
            staffid : "991234"
        }
    });
</script>
<script type="text/javascript">
    $(function(){

    });
</script>