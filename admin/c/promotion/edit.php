<?php
$db = new DB();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $ar1 = array("updated_at"=> date("Y-m-d H:i:s"), "id"=> $_GET["id"]);
    $query = "update promotion SET title=:title,description=:description,content=:content,updated_at=:updated_at WHERE id=:id";

    if(isset($_FILES["picture"]) && file_exists($_FILES["picture"]["tmp_name"])){
        $name = $_FILES["file"]["name"];
        $ext = end(explode(".", $name));

        $pic_name = uniqid("pic_").".".$ext;
        move_uploaded_file($_FILES["picture"]["tmp_name"], "../picture/".$pic_name);

        $ar1["picture"] = $pic_name;
        $query = "update promotion SET title=:title,description=:description,content=:content,updated_at=:updated_at,picture=:picture WHERE id=:id";
    }
    $bp = array_merge($_POST, $ar1);
    $rs = $db->query($query, $bp);

    if($rs){
        //header("refresh:2; url=home.php?page=blog");
        header("location: home.php?page=promotion");
        exit();
    }
}
$item = $db->row("select * from promotion WHERE id=:id", array("id"=> $_GET["id"]));
if(!$item){
    header("refresh:2; url=home.php?page=promotion");
    echo "Not found item";
    exit();
}
$param = $item;
?>
<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <fieldset>

        <!-- Form Name -->
        <legend>Create blog</legend>

        <!-- File Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="filebutton">picture</label>
            <div class="col-md-4">
                <?php $picurl = empty($param["picture"])? "../picture/default.jpg":"../picture/".$param["picture"]; ?>
                <img src="<?php echo $picurl;?>" style="max-width: 100px; max-height: 100px;">
                <input id="picture" name="picture" class="input-file" type="file">
            </div>
        </div>


        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="title">title</label>
            <div class="col-md-4">
                <input id="title" name="title" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $param["title"];?>">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="author">description</label>
            <div class="col-md-4">
                <textarea id="description" name="description" class="form-control"><?php echo $param["description"];?></textarea>
            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="content">content</label>
            <div class="col-md-4">
                Upload Picture <img src="http://www.k0w.co/cms/assets/admin/images/icons/media.png"  style="cursor:pointer" class="picupload"

                                    href="uploads.php?fn=text_edit" /><br />
                <textarea class="form-control" id="content" name="content"><?php echo $param["content"];?></textarea>
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