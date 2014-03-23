<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 23/3/2557
 * Time: 9:38 น.
 * To change this template use File | Settings | File Templates.
 */
$path = __DIR__.'/menu_style.ini';

require_once("../class/INI.class.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $write['menu_style'] = $_POST;
    INI::write($path, $write);
}

$read = INI::read($path);
$read = @$read["menu_style"];
?>
<ol class="breadcrumb">
    <li><a href="home.php?page=setting">Setting</a></li>
    <li class="active">Menu Style</li>
</ol>
<form method="post" enctype="multipart/form-data" style="width: 900px; padding-bottom: 20px;">
    <fieldset>
        <legend>Menu Style</legend>
        <div class="form-group">
            <label class="col-md-4 control-label">menu color</label>
            <div class="col-md-4">
                <input id="menu_color" name="menu_color" type="hidden" placeholder="" class="input-md" required="">
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
            <label class="col-md-4 control-label">highlight menu color</label>
            <div class="col-md-4">
                <input id="highlight_menu_color" name="highlight_menu_color" type="hidden" placeholder="" class="input-md" required="">
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
            $("#menu_color").val(color);
        }
    });
    $("#colorselector_2").colorselector("setColor", "<?php echo @$read["menu_color"];?>");

    $('#colorselector_3').colorselector({
        callback: function (value, color, title) {
            $("#highlight_menu_color").val(color);
        }
    });
    $("#colorselector_3").colorselector("setColor", "<?php echo @$read["highlight_menu_color"];?>");
});
</script>