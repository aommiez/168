<?php
$db = new DB();
if($_SERVER["REQUEST_METHOD"]=="POST"){

    //unique tags
    $tags = array_unique(explode(",", $_POST["tags"]));
    $_POST["tags"] = implode(",", $tags);

    $ar1 = array("updated_at"=> date("Y-m-d H:i:s"), "id"=> $_GET["id"]);
    $query = "update promotion SET title=:title,description=:description,content=:content,updated_at=:updated_at,tags=:tags,color=:color,is_main=:is_main WHERE id=:id";

    $bp = array_merge($_POST, $ar1);
    $rs = $db->query($query, $bp);
    $pro_id = $_GET["id"];

    if(isset($_FILES["picture"]) && file_exists($_FILES["picture"]["tmp_name"])){
        $name = $_FILES["file"]["name"];
        $ext = end(explode(".", $name));

        $pic_name = uniqid("pic_").".".$ext;
        move_uploaded_file($_FILES["picture"]["tmp_name"], "../picture/".$pic_name);

        $ar1["picture"] = $pic_name;
        $query = "update promotion set picture=:picture WHERE id=:id";
        $db->query($query, array("picture"=> $pic_name, "id"=> $pro_id));
    }

    if(isset($_POST["tags"])){
        $sql = "insert into tags(name,pro_id) VALUES(:name,:pro_id)";
        foreach($tags as $key => $value){
            $rs = $db->query($sql, array("name"=> $value, "pro_id"=> $pro_id));
        }
    }

    $db->query("delete from tags WHERE pro_id NOT IN(select id from promotion) OR name=''");

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
        <legend>Edit promotion</legend>

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
            <label class="col-md-4 control-label" for="title">type</label>
            <div class="col-md-4">
                <select name="is_main" class="form-control">
                    <option value="0" <?php if($param["is_main"]==0) echo "selected";?>>normal</option>
                    <option value="1" <?php if($param["is_main"]==1) echo "selected";?>>main</option>
                </select>
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
                <input id="description" name="description" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $param["description"];?>">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="author">color</label>
            <div class="col-md-4">
                <input id="color" name="color" type="hidden" placeholder="" class="input-md" required="">
                <select id="colorselector_2">
                    <option value="106" data-color="#A0522D">sienna</option>
                    <option value="47" data-color="#CD5C5C" selected="selected">indianred</option>
                    <option value="87" data-color="#FF4500">orangered</option>
                    <option value="17" data-color="#008B8B">darkcyan</option>
                    <option value="18" data-color="#B8860B">darkgoldenrod</option>
                    <option value="68" data-color="#32CD32">limegreen</option>
                    <option value="42" data-color="#FFD700">gold</option>
                    <option value="77" data-color="#48D1CC">mediumturquoise</option>
                    <option value="107" data-color="#87CEEB">skyblue</option>
                    <option value="46" data-color="#FF69B4">hotpink</option>
                    <option value="47" data-color="#CD5C5C">indianred</option>
                    <option value="64" data-color="#87CEFA">lightskyblue</option>
                    <option value="13" data-color="#6495ED">cornflowerblue</option>
                    <option value="15" data-color="#DC143C">crimson</option>
                    <option value="24" data-color="#FF8C00">darkorange</option>
                    <option value="78" data-color="#C71585">mediumvioletred</option>
                    <option value="123" data-color="#000000">black</option>
                    <option value="124" data-color="#FFFFFF">white</option>
                    <option value="125" data-color="#C0C0C0">silver</option>
                </select>
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

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="author">tags</label>
            <div class="col-md-4">
                <input id="tags" name="tags" type="text" placeholder="" class="form-control input-md" value="<?php echo $param["tags"];?>">
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

            width: 550,
            height: 350,

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

        $('#tags').tagsInput();

        $('#colorselector_2').colorselector({
            callback: function (value, color, title) {
                $("#color").val(color);
            }
        });
        $("#colorselector_2").colorselector("setColor", "<?php echo $item["color"];?>");
    });
</script>