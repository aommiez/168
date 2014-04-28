<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 23/3/2557
 * Time: 8:19 น.
 * To change this template use File | Settings | File Templates.
 */

$db = new DB();
$item = $db->row("select * from menu WHERE id={$_GET['menu_id']}");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $bp = $_POST;
    $bp['menu_id'] = $_GET["menu_id"];

    $query = "insert into menu_lv2(name,display,menu_id,content) VALUES(:name,1,:menu_id,:content)";
    $rs = $db->query($query, $bp);

    if($rs){
        //header("refresh:2; url=home.php?page=blog");
        header("location: home.php?page=editor/menu_lv2&menu_id=".$_GET["menu_id"]);
        exit();
    }
}?>
<ol class="breadcrumb">
    <li><a href="home.php?page=editor">Editor</a></li>
    <li><a href="home.php?page=editor/menu_lv2&menu_id=<?php echo $_GET["menu_id"];?>"><?php echo $item["name"];?></a></li>
    <li class="active">Create Menu</li>
</ol>
<form class="form-horizontal" method="post">
    <fieldset>

        <!-- Form Name -->
        <legend>Create Menu</legend>

        <!-- Input Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">name</label>
            <div class="col-md-4">
                <input id="name" name="name" class="form-control" type="text">
            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="content">content</label>
            <div class="col-md-4">
                Upload Picture <img src="http://www.k0w.co/cms/assets/admin/images/icons/media.png"  style="cursor:pointer" class="picupload"

                                    href="uploads.php?fn=text_edit" /><br />
                <textarea class="form-control" id="content" name="content"><?php echo $item["content"];?></textarea>
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