<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 23/3/2557
 * Time: 9:38 น.
 * To change this template use File | Settings | File Templates.
 */
$path = __DIR__.'/page_style.ini';

require_once("../class/INI.class.php");

$dir = "../picture/";

$read = INI::read($path);
$read = @$read["page_style"];
if(!$read)
    $read = array();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $write['page_style'] = array_merge($read, $_POST);
    if(isset($_FILES["header_picture"]) && file_exists($_FILES["header_picture"]["tmp_name"])){
        $ex = explode(".", $_FILES["header_picture"]["name"]);
        $ex = array_pop($ex);

        $name = uniqid("gal_").".".$ex;
        move_uploaded_file($_FILES["header_picture"]["tmp_name"], $dir.$name);
        $img = $name;
        $write['page_style']['header_picture'] = $img;
    }
    if(isset($_FILES["background_picture"]) && file_exists($_FILES["background_picture"]["tmp_name"])){
        $ex = explode(".", $_FILES["background_picture"]["name"]);
        $ex = array_pop($ex);

        $name = uniqid("gal_").".".$ex;
        move_uploaded_file($_FILES["background_picture"]["tmp_name"], $dir.$name);
        $img = $name;
        $write['page_style']['background_picture'] = $img;
    }
    if(isset($_FILES["left_block_picture"]) && file_exists($_FILES["left_block_picture"]["tmp_name"])){
        $ex = explode(".", $_FILES["left_block_picture"]["name"]);
        $ex = array_pop($ex);

        $name = uniqid("gal_").".".$ex;
        move_uploaded_file($_FILES["left_block_picture"]["tmp_name"], $dir.$name);
        $img = $name;
        $write['page_style']['left_block_picture'] = $img;
    }
    if(isset($_FILES["footer_picture"]) && file_exists($_FILES["footer_picture"]["tmp_name"])){
        $ex = explode(".", $_FILES["footer_picture"]["name"]);
        $ex = array_pop($ex);

        $name = uniqid("gal_").".".$ex;
        move_uploaded_file($_FILES["footer_picture"]["tmp_name"], $dir.$name);
        $img = $name;
        $write['page_style']['footer_picture'] = $img;
    }

    INI::write($path, $write);
}

$read = INI::read($path);
$read = @$read["page_style"];
?>
<ol class="breadcrumb">
    <li><a href="home.php?page=setting">Setting</a></li>
    <li class="active">Page style</li>
</ol>
<form method="post" action="home.php?page=setting/page_style" enctype="multipart/form-data" style="width: 900px; padding-bottom: 20px;">
    <fieldset>
        <legend>Page Style</legend>
        <div class="form-group">
            <label class="col-md-4 control-label">header picture</label>
            <div class="col-md-4">
                <div>
                    <?php if(@$read["header_picture"]){?>
                    <img src="<?php echo "../picture/".$read["header_picture"];?>" style="max-width: 100px; max-height: 100px;">
                    <?php }?>
                </div>
                <input name="header_picture" class="input-file" type="file">
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">left block picture</label>
            <div class="col-md-4">
                <div>
                    <?php if(@$read["left_block_picture"]){?>
                        <img src="<?php echo "../picture/".$read["left_block_picture"];?>" style="max-width: 100px; max-height: 100px;">
                    <?php }?>
                </div>
                <input name="left_block_picture" class="input-file" type="file">
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">left block color</label>
            <div class="col-md-4">
                <input id="left_block_color" name="left_block_color" type="hidden" placeholder="" class="input-md" required="">
                <select id="colorselector_3">
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
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">left block background type</label>
            <div class="col-md-4">
                <input type="radio" name="left_block_type" value="picture" <?php if(@$read["left_block_type"]=="picture") echo "checked";?>> picture<br />
                <input type="radio" name="left_block_type" value="color" <?php if(@$read["left_block_type"]=="color") echo "checked";?>> color
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- bg -->
        <div class="form-group">
            <label class="col-md-4 control-label">background picture</label>
            <div class="col-md-4">
                <div>
                    <?php if(@$read["background_picture"]){?>
                        <img src="<?php echo "../picture/".$read["background_picture"];?>" style="max-width: 100px; max-height: 100px;">
                    <?php }?>
                </div>
                <input name="background_picture" class="input-file" type="file">
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">background color</label>
            <div class="col-md-4">
                <input id="background_color" name="background_color" type="hidden" placeholder="" class="input-md" required="">
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
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">background type</label>
            <div class="col-md-4">
                <input type="radio" name="background_type" value="picture" <?php if(@$read["background_type"]=="picture") echo "checked";?>> picture<br />
                <input type="radio" name="background_type" value="color" <?php if(@$read["background_type"]=="color") echo "checked";?>> color
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- footer -->
        <div class="form-group">
            <label class="col-md-4 control-label">footer background picture</label>
            <div class="col-md-4">
                <div>
                    <?php if(@$read["footer_picture"]){?>
                        <img src="<?php echo "../picture/".$read["footer_picture"];?>" style="max-width: 100px; max-height: 100px;">
                    <?php }?>
                </div>
                <input name="footer_picture" class="input-file" type="file">
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">footer background color</label>
            <div class="col-md-4">
                <input id="footer_color" name="footer_color" type="hidden" placeholder="" class="input-md" required="">
                <select id="colorselector_4">
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
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">footer background type</label>
            <div class="col-md-4">
                <input type="radio" name="footer_type" value="picture" <?php if(@$read["footer_type"]=="picture") echo "checked";?>> picture<br />
                <input type="radio" name="footer_type" value="color" <?php if(@$read["footer_type"]=="color") echo "checked";?>> color
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
$(function(){
    $('#colorselector_2').colorselector({
        callback: function (value, color, title) {
            $("#background_color").val(color);
        }
    });
    $("#colorselector_2").colorselector("setColor", "<?php echo @$read["background_color"];?>");

    $('#colorselector_3').colorselector({
        callback: function (value, color, title) {
            $("#left_block_color").val(color);
        }
    });
    $("#colorselector_3").colorselector("setColor", "<?php echo @$read["left_block_color"];?>");

    $('#colorselector_4').colorselector({
        callback: function (value, color, title) {
            $("#footer_color").val(color);
        }
    });
    $("#colorselector_4").colorselector("setColor", "<?php echo @$read["footer_color"];?>");
});
</script>