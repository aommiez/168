<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 15/2/2557
 * Time: 11:52 น.
 * To change this template use File | Settings | File Templates.
 */

require_once("../class/INI.class.php");
$read = INI::read("gallery.ini");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $write = $_POST;

    $dir = "../gallery/";
    $defaultImg = "default.png";

    for($i=0; $i<7; $i++){
        if(isset($_FILES["pic{$i}"]["tmp_name"]) && file_exists($_FILES["pic{$i}"]["tmp_name"])){
            $ex = explode(".", $_FILES["pic{$i}"]["name"]);
            $ex = array_pop($ex);

            $name = uniqid("gal_").".".$ex;
            move_uploaded_file($_FILES["pic{$i}"]["tmp_name"], $dir.$name);
            $img = $name;
        }
        else if(!isset($read["img"][$i]["img"])){
            $img = $defaultImg;
        }
        else {
            $img = $read["img"][$i]["img"];
        }
        $write["img"][$i]["img"] = $img;
    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        INI::write("gallery.ini", $write);
    }
    echo "update gallery!!";
    header("refresh:2;");
    exit();
}
?>
<div>
    <h1>Gallery Setting</h1>
    <form method="post" enctype="multipart/form-data" style="width: 900px; padding-bottom: 20px;">
        <?php for($i=0; $i<7; $i++){?>
        <fieldset>
            <legend>Image <?php echo $i+1;?></legend>
            <div class="form-group">
                <label>picture</label>
                <input type="file" name="pic<?php echo $i;?>">
            </div>
            <div class="form-group">
                <label>title</label>
                <input type="text" name="img[<?php echo $i;?>][title]" class="form-control" value="<?php echo $read["img"][$i]["title"];?>">
            </div>
            <div class="form-group">
                <label>description</label>
                <input type="text" name="img[<?php echo $i;?>][description]" class="form-control" value="<?php echo $read["img"][$i]["description"];?>">
            </div>
        </fieldset>
        <?php }?>
        <div><button type="submit" class="btn btn-primary">submit</button></div>
    </form>
</div>
<style type="text/css">
fieldset {
    padding: 10px 20px 20px 20px;
    border: 1px solid rgba(0, 0, 0, 0.15);
    margin-bottom: 20px;
    margin-right: 20px;
    display: inline-block;
    width: 400px;
}
legend {
    display: inline-block;
    width: auto;
    border: none;
    padding: 0 10px;
}
</style>