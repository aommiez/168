<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 10/2/2557
 * Time: 10:16 น.
 * To change this template use File | Settings | File Templates.
 */
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $db = new DB();
    $ar1 = array("created_at"=> date("Y-m-d H:i:s"), "updated_at"=> date("Y-m-d H:i:s"));
    $bp = array_merge($_POST, $ar1);
    $rs = $db->query("insert into blog(title,author,content,created_at,updated_at) VALUES(:title,:author,:content,:created_at,:updated_at)", $bp);

    if($rs){
        echo "success";
        header("refresh:2; url=home.php?page=blog");
    }
}
?>
<form class="form-horizontal" method="post">
    <fieldset>

        <!-- Form Name -->
        <legend>Create blog</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="title">title</label>
            <div class="col-md-4">
                <input id="title" name="title" type="text" placeholder="" class="form-control input-md" required="">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="author">author</label>
            <div class="col-md-4">
                <input id="author" name="author" type="text" placeholder="" class="form-control input-md" required="">

            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="content">content</label>
            <div class="col-md-4">
                Upload Picture <img src="http://www.k0w.co/cms/assets/admin/images/icons/media.png"  style="cursor:pointer" class="picupload"

                                    href="uploads.php?fn=text_edit" /><br />
                <textarea class="form-control" id="content" name="content"></textarea>
            </div>
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
    $(function() {
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

        $(".picupload").fancybox({
            'width'				: '75%',
            'height'			: '80%',
            'autoScale'			: false,
            'transitionIn'		: 'none',
            'transitionOut'		: 'none',
            'type'				: 'iframe'
        });
    });
</script>