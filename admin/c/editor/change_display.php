<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 23/3/2557
 * Time: 8:32 น.
 * To change this template use File | Settings | File Templates.
 */

$db = new DB();
$type = "menu";
if(isset($_GET["type"]))
    $type = $_GET["type"];

$rs = $db->query("update {$type} set display=:display WHERE id=:id", array(
    "display"=> $_GET["display"],
    "id"=> $_GET["id"]
));

header("location: ".$_SERVER["HTTP_REFERER"]);