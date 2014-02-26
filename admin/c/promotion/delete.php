<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 11/2/2557
 * Time: 9:41 น.
 * To change this template use File | Settings | File Templates.
 */

$db = new DB();
$rs = $db->query("delete from promotion WHERE id=:id", array("id"=> $_GET["id"]));
$db->query("delete from tags WHERE pro_id NOT IN(select id from promotion)");
if(!$rs){
    header("refresh:2; url=home.php?page=promotion");
    echo "Not found item";
    exit();
}
header("location: home.php?page=promotion");