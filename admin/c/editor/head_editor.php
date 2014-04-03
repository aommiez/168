<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 18/2/2557
 * Time: 10:51 น.
 * To change this template use File | Settings | File Templates.
 */

$db = new DB();
$type = "menu";
if(isset($_GET["type"]))
    $type = $_GET["type"];

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $rs = $db->query("update menu set name=:name WHERE id=:id", array(
        "name"=> $_POST["name"],
        "id"=> $_GET["id"]
    ));

    //if($rs){
        //header("refresh:2; url=home.php?page=blog");
        header("location: home.php?page=editor");
        exit();
    //}
}

$item = $db->row("select * from menu WHERE id=:id", array("id"=> $_GET["id"]));

?>
<form class="form-horizontal" method="post">
    <input type="hidden" name="menu_id" value="<?php echo $item["id"];?>">
    <fieldset>
        <legend><?php echo $item["name"];?></legend>
        <!-- input -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">name</label>
            <div class="col-md-4">
                <input class="form-control" id="name" name="name" value="<?php echo $item["name"];?>">
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