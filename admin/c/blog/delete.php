<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 11/2/2557
 * Time: 9:41 น.
 * To change this template use File | Settings | File Templates.
 */

$db = new DB();
$rs = $db->query("delete from blog WHERE id=:id", array("id"=> $_GET["id"]));
if(!$rs){
    header("refresh:2; url=home.php?page=blog");
    echo "Not found item";
    exit();
}
header("location: home.php?page=blog");