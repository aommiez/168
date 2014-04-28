<?php
/**
 * Created by PhpStorm.
 * User: Papangping
 * Date: 4/28/14
 * Time: 9:53 AM
 */


$db = new DB();
$rs = $db->query("delete from menu_lv2 WHERE id=:id", array("id"=> $_GET["id"]));
if(!$rs){
    header("refresh:2; url=home.php?page=editor/menu_lv2&menu_id=".$_GET["menu_id"]);
    echo "Not found item";
    exit();
}
header("location: home.php?page=editor/menu_lv2&menu_id=".$_GET["menu_id"]);