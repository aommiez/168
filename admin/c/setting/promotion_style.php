<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 23/3/2557
 * Time: 9:38 น.
 * To change this template use File | Settings | File Templates.
 */
$path = __DIR__.'/promotion_style.ini';

require_once("../class/INI.class.php");

$dir = "../picture/";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $write['promotion_style'] = $_POST;
    INI::write($path, $write);
}

$read = INI::read($path);
$read = @$read["promotion_style"];
?>
<ol class="breadcrumb">
    <li><a href="home.php?page=setting">Setting</a></li>
    <li class="active">Promotion style</li>
</ol>
<form method="post" enctype="multipart/form-data" style="width: 900px; padding-bottom: 20px;">
    <fieldset>
        <legend>Promotion Style</legend>
        <div class="form-group">
            <div class="form-group">
                <label class="col-md-4 control-label">title color</label>
                <div class="col-md-4">
                    <input id="title_color" name="title_color" type="hidden" placeholder="" class="input-md" required="">
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
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label class="col-md-4 control-label">display per page</label>
                <div class="col-md-4">
                    <select name="display_per_page">
                        <?php for($i=3; $i <= 10;$i++){?>
                        <option value="<?php echo $i;?>" <?php if(@$read["display_per_page"]==$i) echo "selected";?>><?php echo $i;?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="clearfix"></div>
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
$(function(){
    $('#colorselector_2').colorselector({
        callback: function (value, color, title) {
            $("#title_color").val(color);
        }
    });
    $("#colorselector_2").colorselector("setColor", "<?php echo @$read['title_color']?>");
});
</script>